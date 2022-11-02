<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use GViP\Mail\Mail,
	GViP\Mail\EmailRecipient;

class Marketing extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/admin.php/welcome
	 *	- or -
	 * 		http://example.com/admin.php/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /admin.php/welcome/<method_name>
	 */
	public $headerdata = array();

	/**
	* Constructor
	* Called when the object is created
	*
	* @access public
	*/
	public function __construct()
	{
		parent::__construct();

		// Session check for the Login Status, redirect to Account Settings Page
		// unless logged in as an admin user 
		// OR controller is being run from the command line
		if(!sess_var('admin_logged_in') && !$this->input->is_cli_request())
		{
			redirect('','refresh');
		}

		// load model
		$this->load->model('members_model');
		$this->load->model('projects_model');

		//Set Header Data for this page like title,bodyid etc
		$this->headerdata["bodyclass"] = "withvernav";
	}

	/**
	 * Shows index page allowing user to create the HTML for an email
	 * 
	 * @return HTML
	 */
	public function index()
	{
		$this->headerdata['title'] = $data['headertitle'] = "Weekly Email | GViP Admin";

		$this->load->view('templates/header', $this->headerdata);
		$this->load->view('templates/leftmenu');
		$this->load->view('marketing/index', $data);
		$this->load->view('templates/footer');
	}

	public function algosemail()
	{
		$this->headerdata['title'] = $data['headertitle'] = "Algorithms Email | GViP Admin";
		$data['emailSuccess'] = $this->input->get('emailsuccess');

		$this->load->view('templates/header', $this->headerdata);
		$this->load->view('templates/leftmenu');
		$this->load->view('marketing/algosemail', $data);
		$this->load->view('templates/footer');	
	}

	/**
	 * Show page letting user see the recommendations generated by the engine
	 * for all attendees of a given forum
	 */
	public function show_forum_recommendations(int $forumId = 31)
	{
		$this->load->model('algosemail_model');
		$this->load->model('forums_model');

		$this->load->library('pagination');

		$config['base_url'] = "/admin.php/marketing/algosemail/forums/{$forumId}";
		$config['total_rows'] = 100;
		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		$data['paginationLinks'] = $this->pagination->create_links();

		$this->headerdata['title'] = $data['headertitle'] = "Algorithms Email | GViP Admin";
		
		$offset = $this->uri->segment(3);
		$data['attendees'] = $this->forums_model->get_filtered_user_list($forumId, 5, $offset)['filter'];
		foreach ($data['attendees'] as &$attendee) {
			$attendee['recommendations'] = $this->algosemail_model->get_forum_recommendations($attendee['uid'], $forumId, 3);
		}


		

		$this->load->view('templates/header', $this->headerdata);
		$this->load->view('templates/leftmenu');
		$this->load->view('marketing/algosemail/show_forum_recommendations', $data);
		$this->load->view('templates/footer');	
	}

	/**
	 * Endpoint to email all members
	 * Works via GUI or CLI
	 */
	public function email_all_members()
	{
		ini_set('max_execution_time', 90); // TODO: Optimize so this can be run in 30s or less
		$success = $this->send_recommendations_to_all_members();
		
		if (is_cli()) {
			echo "The email was " . ($success ? "" : "NOT ") . "sent successfully.\n";
			return;
		}

		$menuUrl = '/marketing/algosemail';
		if ($success) {
			redirect($menuUrl . '?emailsuccess=true');
		}
		else {
			redirect($menuUrl . '?emailsuccess=false');
		}
	}

	/**
	 * Send an email with three recommended experts to each GViP member
	 * @return bool Whether the email was successfully sent
	 */
	private function send_recommendations_to_all_members()
	{
		$this->load->model('algosemail_model');
		$recommendationsData = $this->algosemail_model->get_recommendations_for_all_users(3);
		
		// Only send the email to members for whom we have three recommendations
		$membersWithRecommendations = array_filter($recommendationsData, function($member) {
			return count($member['recommendations']) === 3;
		});

		$recipients = array_map(function($member) {
			return (new EmailRecipient(
					$member['forMember']['firstname'] . ' ' . $member['forMember']['lastname'],
					$member['forMember']['email']
				)
			)->addSubstitutionData([
				'experts' => $member['recommendations'],
				'firstname' => $member['forMember']['firstname'],
				'month' => date('F'),
				'uid' => $member['forMember']['uid'],
			]);
		}, $membersWithRecommendations);
		
		$email = new Mail();
		return $email->addRecipients($recipients)
					 ->subject('Your GViP expert recommendations for ' . date('F'))
					 ->body($this->load->view('marketing/emails/algosemail_html', '', true))
					 ->send();
	}

	public function mailtest()
	{
		$this->load->model('algosemail_model');
		$recommendedExperts = $this->algosemail_model->get_recommendations(28, 3);

		if (empty($recommendedExperts)) { // Don't email someone if we don't have any recommendations for them!
			echo "No experts to recommend :(";
			return;
		}

		$recipients = [
			(new EmailRecipient('Michael Pavey', 'michael@cg-la.com'))->addSubstitutionData([
				'experts' => $recommendedExperts,
				'firstname' => 'Norman',
				'month' => date('F'),
				'uid' => 28,
			])
		];

		$email = new Mail();
		$email->addRecipients($recipients)
			  ->subject('Your GViP expert recommendations for ' . date('F'))
			  ->body($this->load->view('marketing/emails/algosemail_html', '', true))
			  ->send();
	}

	/**
	 * Generate HTML to send out as an email, using the weekly email template
	 * @return void Shows a page from which the HTML can be copied to clipboard
	 */
	public function generatehtml()
	{
		$data['headertitle'] = $this->headerdata['title'];
		$data['errors'] = [];

		$expertURLs = array_filter($this->input->post('experts') ?: []);
		$projectURLs = array_filter($this->input->post('projects') ?: []);
		
		if (count($expertURLs) < 4 || count($projectURLs) < 4) {
			$data['errors'][] = "You didn't include enough experts/projects! Please go back and ensure all fields are completed.";
		}

		$expertsData = array_filter($this->get_experts_data_for_email($expertURLs));
		
		if (count($expertsData) < 4) {
			$data['errors'][] = "Not all the experts appear to exist in the database. Please check you copied the URLs correctly!";
		}
		foreach ($expertsData as &$expert) {
			$expert['imageURL'] = "https://www.gvip.io" . expert_image($expert['userphoto'], 120);
		}

		$projectsData = array_filter($this->get_projects_data_for_email($projectURLs));
		if (count($projectsData) < 4) $data['errors'][] = "Not all the projects appear to exist in the database. Please check you copied the URLs correctly!";
		foreach ($projectsData as &$project) {
			$project['imageURL'] = "https://www.gvip.io" . project_image($project['projectphoto'], 120);
		}

		$data = array_merge(compact('expertsData', 'projectsData'), $data);

		$this->load->view('templates/header', $this->headerdata);
		$this->load->view('templates/leftmenu');
		$this->load->view('marketing/generatehtml', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Fetch from DB the experts data required for the weekly email template
	 * @param  array $expertURLs Array of strings containing URLs for expert profile pages
	 * @return array             Array of associative arrays each containing info on an expert
	 */
	private function get_experts_data_for_email($expertURLs)
	{
		$expertsData = [];
		$requiredExpertFields = "uid, firstname, lastname, title, organization, userphoto";
		
		// TODO: Consider implementing (or finding) a new method to retrieve all rows in a single query
		foreach ($expertURLs as $expertURL) {
			if (!preg_match('/\d+$/', $expertURL, $matches)) continue;
			$uid = (int) $matches[0];
			$expertsData[] = $this->members_model->find($uid, $requiredExpertFields);
		}

		return $expertsData;
	}

	/**
	 * Fetch from DB the projects data required for the weekly email template
	 * @param  array $projectURLs Array of strings containing URLs for project profile pages
	 * @return array             Array of associative arrays each containing info on a project
	 */
	private function get_projects_data_for_email($projectURLs)
	{
		$projectsData = [];
		$requiredProjectFields = "slug, projectname, projectphoto";
		
		// TODO: Consider implementing (or finding) a new method to retrieve all rows in a single query
		foreach ($projectURLs as $projectURL) {
			if (!preg_match('/[^\/]+$/', $projectURL, $matches)) continue;
			$slug = $matches[0];
			$projectsData[] = $this->projects_model->find_from_slug($slug, $requiredProjectFields);
		}
		
		return $projectsData;
	}
}