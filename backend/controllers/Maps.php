<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Controller {

    //default class variables
    public $sess_uid;
    public $sess_logged_in;
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

        //Session check for the Login Status, if not logged in then redirect to Home page
        if(!sess_var('admin_logged_in')) {
            redirect('', 'refresh');
        }

        //Load model for this controller
        $this->load->model('maps_model');

        //load form_validation library for default validation methods
        $this->load->library('form_validation');

        //Set Header Data for this page like title,bodyid etc
        $this->sess_uid	 = sess_var('admin_uid');

    }

    /**
     * Retrive a list of all maps.
     *
     */
    public function index()
    {
        $headers = array(
            'bodyid' => 'Maps',
            'bodyclass' => 'withvernav',
            'title' => 'View Maps | GViP Admin Interface',
            'js' => array(
                '/themes/js/plugins/jquery.dataTables.min.js',
                '/themes/js/plugins/chosen.jquery.min.js',
                '/themes/js/plugins/jquery.alerts.js'
            ),
            'pagejs' => array('/themes/js/custom/tables.js')
        );
        //$this->headerdata = $headers;

        // Load a list of all maps from the model.
        $rows = $this->maps_model->all();
        $categories = $this->maps_model->categories();

        // Render HTML Page from views
        $this->load->view('templates/header', $headers);
        $this->load->view('templates/leftmenu');
        $this->load->view('maps/index', array(
            'main_content' => 'rows',
            'rows' => $rows,
            'categories' => flatten_assoc($categories, 'name', 'name')
        ));
        $this->load->view('templates/footer');
    }

    /**
     * Delete map(s) entry(ies) by id(s)
     *
     */
    public function destroy() {
        $ids = $this->input->get('delids');

        if (count($ids) > 0) {
            if ($this->maps_model->delete($ids)) {
                sendResponse(array(
                    'status' => 'success',
                    'msgtype' => 'success',
                    'msg' => 'Map(s) deleted successfully'
                ));
            } else {
                sendResponse(array(
                    'status' => 'success',
                    'msgtype' => 'error',
                    'msg' => 'Error while deleting map(s).'
                ));
            }
        }
    }

    /**
     * Create a new map entry
     *
     */
    public function create() {
        // Process updates first
        if ($this->input->post('submit')) {

            $this->set_create_validation_rules();

            if ($this->form_validation->run() === TRUE) {
                $now = date('Y-m-d H:i:s');
                $data = array(
                    'title' => $this->input->post('title'),
                    'category_id' => $this->input->post('category_id'),
                    'style_url' => '0',
                    'status' => '0',
                    'show_geojson' => '4',
                    'created_at' => $now,
                    'updated_at' => $now
                );
                if ($id = $this->maps_model->create($data)) {
                    redirect("maps/edit/$id", 'refresh');
                }
            }
        }

        // Then load the view
        $headers = array(
            'bodyid' => 'Maps',
            'bodyclass' => 'withvernav',
            'title' => 'Add New Map | GViP Admin Interface',
            'js' => array(
                '/themes/js/plugins/jquery.dataTables.min.js',
                '/themes/js/plugins/chosen.jquery.min.js',
                '/themes/js/plugins/jquery.alerts.js'
            ),
            'pagejs' => array('/themes/js/custom/tables.js')
        );

        // Fetch necessary data
        $categories = flatten_assoc($this->maps_model->categories(), 'id', 'name');

        // Render the page from views
        $this->load->view('templates/header', $headers);
        $this->load->view('templates/leftmenu');
        $this->load->view('maps/create', array('categories' => $categories));
        $this->load->view('templates/footer');
    }

    /**
     * Edit a specified map entry by id
     * @param $id
     * @param string $selectedtab
     */
    public function edit($id, $selectedtab = '') {
        // Convert $id to integer
        $id = (int)$id;

        // Process updates first
        if ($this->input->post('submit')) {
            $update = $this->input->post('update');
            // Grab all input and remove submit
            $input = array_diff_key($this->input->post(NULL, TRUE), array(
                'submit' => null,
                'update' => null
            ));

            switch ($update) {
                case 'general':
                    $this->update($id, $input);
                    break;
                case 'photo':
                case 'banner':
                    $this->upload_image($id, $update);
                    break;
                case 'projects':
                    $this->update_projects($id, $input);
                    break;
                case 'experts':
                    $this->update_experts($id, $input);
                    break;
            }
        }

        $headers = array(
//            'bodyid' => 'Forums',
            'bodyclass' => 'withvernav',
            'title' => 'Edit Map | GViP Admin Interface',
            'js' => array(
                '/themes/js/plugins/jquery.validate.min.js',
                '/themes/js/plugins/jquery.tagsinput.min.js',
                '/themes/js/plugins/charCount.js',
                '/themes/js/plugins/ui.spinner.min.js',
                '/themes/js/plugins/chosen.jquery.min.js',
                '/themes/js/plugins/jquery.dataTables.min.js',
                '/themes/js/plugins/jquery.bxSlider.min.js',
                '/themes/js/plugins/jquery.slimscroll.js'
            ),
            'pagejs' => array(
                '/themes/js/custom/forms.js',
//                '/themes/js/custom/tables.js',
                '/themes/js/custom/widgets.js'
            )
        );

        // Fetch necessary data
        $model = $this->maps_model;
        $details  = $model->find($id);
        $projects = $model->all_projects($id);
        $experts  = $model->all_members($id);
        $categories = flatten_assoc($model->categories(), 'id', 'name');
        $styles = flatten_assoc($model->styles(), 'id', 'name');

        $data = array(
            'details' => $details,
            'projects' => $projects,
            'experts' => $experts,
            'categories' => $categories,
            'styles' => $styles
        );

        // Render the page
        $this->load->view('templates/header', $headers);
        $this->load->view('templates/leftmenu');
        $this->load->view('maps/edit', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Update a specified map entry
     *
     * @param int $id
     * @param array $input
     * @return bool
     */
    private function update($id, $input) {
        $this->set_update_validation_rules();

        if ($this->form_validation->run() === TRUE) {
            // Ensure we have required flags set
            $input['status'] = (isset($input['status'])) ? '1' : '0';
            $input['show_geojson'] = (isset($input['show_geojson'])) ? '1' : '0';

            // Convert empty strings to NULLs
            $input = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $input);

            // Decode iframe tags from html entities
            if (isset($input['content']) && ! is_null($input['content'])) {
                $input['content'] = decode_iframe($input['content']);
            }

            $this->maps_model->update($id, $input);
            redirect('/maps/edit/' . $id, 'refresh');
        }
    }

    /**
     * Upload an image and update a specified map entry
     *
     * @param string $id
     * @param string $image_type
     * @return mixed
     */
    private function upload_image($id, $image_type) {

        $sizes = array(
            'photo' => array(
                array('width'=>'396','height'=>'396'),
                array('width'=>'198','height'=>'198')
            )
        );

        $image = upload_image(FORUM_IMAGE_PATH, 'photo_filename', TRUE, $sizes[$image_type]);

        if ($image['error'] == '') {
            $this->maps_model->update($id, array($image_type => $image['file_name']));
            redirect("/maps/edit/$id/#images", 'refresh');
        }
    }

    /**
     * Update a list of projects accosiated with the map
     *
     * @param $id
     * @param $input
     */
    private function update_projects($id, $input) {
        // Convert the type of project ids from string to integer
        $data = array_map(function($value) {
            return (int) $value;
        }, $input['projects']);

        $this->maps_model->sync_projects($id, $data);
        redirect("/maps/edit/$id/#projects", 'refresh');
    }

    /**
     * Update a list of members(experts) accosiated with (attending) the map
     *
     * @param int $id
     * @param array $input
     */
    private function update_experts($id, $input) {
        // Convert the type of member (expert) ids from string to integer
        $data = array_map(function($value) {
            return (int) $value;
        }, $input['members']);

        $this->maps_model->sync_members($id, $data);

        redirect("/maps/edit/$id/#experts", 'refresh');
    }

    /**
     * Validation callback
     * Returns true if an argument contains only alpha (supporting UTF)-numeric characters, underscores, dashes and spaces
     *
     * @param $value
     * @return bool
     */
    public function alpha_dash_space($value) {
        $regex = "/^([\pL\s\d_-])+$/u";
        return (! preg_match($regex, $value)) ? FALSE : TRUE;
    }

    /**
     * Set validation rules for update and create methods
     *
     */
    private function set_common_validation_rules() {
        $this->form_validation->set_error_delimiters('<label>', '</label>');
        $this->form_validation->set_rules('title', 'Title', 'trim|required|callback_alpha_dash_space');
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha-numeric characters, underscores, dashes and spaces.');
    }

    /**
     * Set validation rules for map update method
     *
     */
    private function set_update_validation_rules() {
        $this->set_common_validation_rules();

        $this->form_validation->set_rules('category_id', 'Category Id', 'required|integer'); // Needed for set_value to work properly
        $this->form_validation->set_rules('style_url', 'Style URL', 'required|integer'); // Needed for set_value to work properly
        $this->form_validation->set_rules('status', ' Map enabled', ''); // Needed for set_value to work properly
        $this->form_validation->set_rules('show_geojson', 'Show GeoJson On MAp', ''); // Needed for set_value to work properly
        $this->form_validation->set_rules('content', 'Map Description', 'trim');

        $this->form_validation->set_message('valid_period', 'Forum dates are invalid.');
    }

    /**
     * Set validation rules for map create method
     *
     */
    private function set_create_validation_rules() {
        $this->set_common_validation_rules();

        $this->form_validation->set_rules('category_id', 'Category Id', 'required|integer');
    }
}
