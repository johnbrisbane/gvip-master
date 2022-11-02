<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Controller {

	protected  $headerdata = array();
    protected  $footer_data = array();

	public function __construct()
	{
		parent::__construct();

		$languageSession = sess_var('lang');
		get_language_file($languageSession);

        // If the user is not logged in then redirect to the login page
        auth_check();

        $this->load->model('maps_model');

        // Load breadcrumb library
        $this->load->library('breadcrumb');

		//Set Header Data for this page like title,bodyid etc
		$this->headerdata['bodyid'] = 'map_search';
		$this->headerdata['bodyclass'] = '';
		$this->headerdata['title'] = build_title('Maps');

		// Set Footer Data
		$this->footer_data['lang'] = langGet();

        $this->sort_options = array(
            1 => 'Sort Alphabetically',
            2 => 'Total Value Descending',
            3 => 'Random'

        );
	}


    public function custom($id)
    {
        $id = (int) $id;

        $model = $this->maps_model;

        $map = $model->find($id);
        // If we can't find a map redirect to the maps list view
        if (empty($map)) {
            redirect('maps', 'refresh');
            exit;
        }

        // Prevent the map in a draft status to be shown
        if (isset($map['status']) && $map['status'] != STATUS_ACTIVE) {
            redirect('maps', 'refresh');
            exit;
        }

        // If the current user doesn't have access to the map show 404
        if (! $this->maps_model->has_access_to(Auth::id(), $id)) {
            show_404();
        }

        $sort = $this->check_sort($this->input->get_post('sort', true));

        $filter = array(
            'state' => $this->input->get_post('state', true),
            'sector' => $this->input->get_post('sector', true),
            'subsector' => $this->input->get_post('subsector', true),
            'stage' => $this->input->get_post('stage', true),
            'searchtext' => $this->input->get_post('searchtext', true)
        );
        array_walk($filter, function (&$value, $key) {
            $value = $value ? : '';
        });

        $sector_data = sector_subsectors();

        $subsectors = array();
        if (! empty($subsector)) {
            if (isset($sector_data[$subsector])) {
                $subsectors = $sector_data[$subsector];
            }
        }

        // Fetch projects and members (experts) accociated with the map
        $projects = $model->projects($id, 'pid, p.slug, projectname, projectphoto, p.keywords, p.sector, p.country, p.lat, p.lng, p.totalbudget, p.sponsor, p.stage, p.subsector, p.location, p.description', array('p.id' => 'random'), 700, 0, true, $filter, $sort);
        $members = $model->get_members_for_map_homepage($id);

        $this->load->model('projects_model');

        $data = array(
            'projects' => array(
                'rows' => $projects,
                'total_rows' => (count($projects) > 0) ? $projects[0]['row_count'] : 0,

            ),
            'members' => array(
                'rows' => $members,
                'total_rows' => (count($members) > 0) ? $members[0]['row_count'] : 0
            ),
            'sort'       => $sort,
            'sort_options' => $this->sort_options,
            'details' => $map,
            'filter'       => $filter,
            'subsectors' => $subsectors,
            'all_subsectors'   => $sector_data,
            'model_obj' => $this->projects_model,
        );

        $this->headerdata['title'] = build_title($map['title']);

        // Provide page analitics data for Segment Analitics
        $this->headerdata['page_analytics'] = array(
            'category' => 'Maps',
            'properties' => array(
                'Target Id' => $id,
                'Target Name' => $map['title']
            )
        );

        // Render the page
        $this->load->view('maps/header_maps', $this->headerdata);
        $this->load->view('maps/map_template', $data);
        $this->load->view('templates/footer', $this->footer_data);
    }

    private function check_sort($value)
    {
        $allowed = array_keys($this->sort_options);
        $default = 3;

        if (in_array($value, $allowed)) {
            return $value;
        } else {
            return $default;
        }
    }

    /**
     * Display a paginated list of maps
     *
     */
    public function index() {

        $limit = view_check_limit($this->input->get_post('limit', TRUE));
        $offset = $this->input->get_post('per_page', TRUE);
        if (empty($offset)) {
            $offset = 0;
        }

        $select = 'f.id, title, category_id, fc.name AS category, style_url, photo, content, status, show_geojson';

        $category   = $this->input->get_post('category', TRUE);
        $searchtext = $this->input->get_post('search_text', TRUE);


        $filterby = array_filter(compact( 'category', 'searchtext'));

        // Fetch maps applying filters and limit for pagination
        $where = array('status' => STATUS_ACTIVE);

        if ($category) {
            $where['category_id'] = (int) trim($category, '[]');
        }
        if (! empty($searchtext)) {
            $terms = split_terms($searchtext);
            $columns = 'title';
            $where[] = where_like($columns, $terms);
        }

        $order_by = array(
            'created_at' => 'desc',
        );

        $rows = $this->maps_model->all($where, $select, $order_by, $limit, $offset, true);
        $total = (count($rows) > 0) ? $rows[0]['row_count'] : 0;
        $categories = $this->maps_model->categories();
        $config = array(
            'base_url' 	 => '/maps?category=' . urlencode($category) .
                '&search_text' . urlencode($searchtext) .
                '&limit=' . urlencode($limit),
            'total_rows' => $total,
            'per_page' 	 => $limit,
            'next_link'	 => lang('Next') . '  ' . '&gt;',
            'prev_link'  => '&lt;' . '  ' . lang('Prev'),
            'first_link' => lang('First'),
            'last_link' =>  lang('Last'),
            'page_query_string' => TRUE
        );
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $pages = $offset != '' ? $offset : 0;
        $page_from = ($total < 1) ? 0 : ($pages + 1);
        $page_to = (($pages + $limit) <= $total) ? ($pages + $limit) : $total;

        $data = array(
            'rows' => $rows,
            'total_rows' => $total,
            'categories' => flatten_assoc($categories, 'id', 'name', '[', ']'),
            'filter_by' => $filterby,
            'paging'   => $this->pagination->create_links(),
            'page_from' => $page_from,
            'page_to'   => $page_to

        );

        $this->breadcrumb->append_crumb('MAPS', '/maps');
        $this->headerdata['breadcrumb'] = $this->breadcrumb->output();

        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('maps/all', $data);
        $this->load->view('templates/footer', $this->footer_data);
    }

    /**
     * Display a paginated list of all projects associated with the map
     *
     * @param $id
     */
    public function projects($id) {

        // If the user is not logged in then redirect to the login page
        auth_check();

        $perpage =	12;
        $page = $this->input->get_post('per_page', TRUE);

        $details = $this->maps_model->find($id, 'f.id, title');

        if (empty($details)) {
            redirect('maps/all', 'refresh');
            exit;
        }

        $rows = $this->maps_model->projects($id, 'pid, p.slug, projectname, projectphoto, p.country, p.sector, stage', null, $perpage, $page, true);
        $total = (count($rows) > 0) ? $rows[0]['row_count'] : 0;

        $config = array (
            'base_url'   => "/maps/projects/$id?",
            'total_rows' => $total,
            'per_page'   => $perpage,
            'next_link'	 => lang('Next') . '  ' . '&gt;',
            'prev_link'  => '&lt;' . '  ' . lang('Prev'),
            'first_link' => FALSE,
            'last_link'  => FALSE,
            'page_query_string' => TRUE
        );
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $pages = $page != '' ? $page : 0;
        $page_from = ($total < 1) ? 0 : ($pages + 1);
        $page_to = (($pages + $perpage) <= $total) ? ($pages + $perpage) : $total;

        $data	=	array(
            'rows'       => $rows,
            'total_rows' => $total,
            'paging'     => $this->pagination->create_links(),
            'page_from'  => $page_from,
            'page_to'    => $page_to
        );

        $this->breadcrumb->append_crumb('Maps', '/maps');
        $this->breadcrumb->append_crumb($details['title'], '/maps/custom' . $details['id']);
        $this->breadcrumb->append_crumb('Map Projects', '/maps/projects/' . $details['id']);
        $this->headerdata['breadcrumb'] = $this->breadcrumb->output();

        $this->headerdata['title'] = build_title('Map Projects');

        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('maps/projects', $data);
        $this->load->view('templates/footer', $this->footer_data);

    }

    /**
     * Display a paginated list of all experts (members) associated with (attending) the map
     *
     * @param $id
     */
    public function experts($id) {

        // If the user is not logged in then redirect to the login page
        auth_check();

        $limit = view_check_limit($this->input->get_post('limit', TRUE));
        $offset = $this->input->get_post('per_page', TRUE);
        $details = $this->maps_model->find($id, 'f.id, title');

        if (empty($details))
        {
            redirect('maps', 'refresh');
            exit;
        }

        if (empty($offset)) {
            $offset = 0;
        }
        $filter = array(
            'country' => $this->input->get_post('country', TRUE),
            'sector' => $this->input->get_post('sector', TRUE),
            'subsector' => $this->input->get_post('subsector', TRUE),
            'searchtext' => $this->input->get_post('searchtext', TRUE),
            'discipline' => $this->input->get_post('discipline', TRUE),
        );
        array_walk($filter, function(&$value, $key) {
            $value = $value ? : '';
        });

        $users = $this->maps_model->get_filtered_user_list($id, $limit, $offset, $filter, MEMBER_TYPE_MEMBER, null);
        $total = $users['filter_total'];

        /* This fixes the 1 - 0 error if no users are found make offset 0*/
        if ($total == 0 ){
            $offset = -1;
        }
        $sector_data = sector_subsectors();
        $subsectors = array();
        if (! empty($subsector)) {
            if (isset($sector_data[$subsector])) {
                $subsectors = $sector_data[$subsector];
            }
        }

        $config = array(
            'base_url'   => '/maps/experts/'.$id.'?'.http_build_query(array_merge($filter, compact('sort', 'limit'))),
            'total_rows' => $total,
            'num_links' => 1,
            'per_page'   => $limit,
            'next_link'	 => lang('Next') . '  ' . '&gt;',
            'prev_link'  => '&lt;' . '  ' . lang('Prev'),
            'first_link' => lang('First'),
            'last_link' =>  lang('Last'),
            'page_query_string' => TRUE
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'users'         => $users['filter'],
            'filter_total'  => $total,
            'filter'        => $filter,
            'sectors'       => array_keys($sector_data),
            'subsectors'    => $subsectors,
            'all_subsectors'=> $sector_data,
            'filter_total'  => $total,
            'iduser'        => $id,
            'limit'         => $limit,
            'paging'        => $this->pagination->create_links(),
            'page_from'     => $offset+1,
            'page_to'       => ($offset + $limit <= $total) ? $offset + $limit : $total
        );

        $this->breadcrumb->append_crumb('Maps', '/maps');
        $this->breadcrumb->append_crumb($details['title'], '/maps/custom/' . $details['id']);
        $this->breadcrumb->append_crumb('Map Experts', '/maps/experts/' . $details['id']);
        $this->headerdata['breadcrumb'] = $this->breadcrumb->output();

        $this->headerdata['title'] = build_title('Map Experts');

        // Analytics
        // Check if we have any search filters setup
        if (count(array_filter($filter)) > 0) {
            $event_properties = array(
                'Category' => 'Map Expert',
                'Found' => $total
            );
            foreach ($filter as $key => $value) {
                if (! empty($value)) {
                    $event_properties[ucfirst($key)] = $value;
                }
            }

            $this->headerdata['page_analytics'] = array(
                'event' => array(
                    'name' => 'Searched',
                    'properties' => $event_properties
                )
            );
        }

        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('maps/experts', $data);
        $this->load->view('templates/footer', $this->footer_data);
    }

    public function rank($id){

        $id = (int) $id;

        $model = $this->forums_model;

        $forum = $model->find($id);
        // If we can't find a forum redirect to the forums list view
        if (empty($forum)) {
            redirect('maps', 'refresh');
            exit;
        }
        // Prevent the forum in a draft status to be shown
        if (isset($forum['status']) && $forum['status'] != STATUS_ACTIVE) {
            redirect('maps', 'refresh');
            exit;
        }

        // Fetch projects and members (experts) accociated with the forum
        $projects = $model->projects($id, 'pid, p.slug, projectname, projectphoto, p.sector, p.country, p.lat, p.lng, p.totalbudget, p.sponsor, p.stage, p.subsector, p.location, p.description', array('p.id' => 'random'), 700, 0, true);

        $this->load->model('projects_model');

        $weights = array(
            'jobweight' => $this->input->get_post('jobweight', true),
            'valueweight' => $this->input->get_post('valueweight', true),
            'jovweight' => $this->input->get_post('jovweight', true),
            'likeweight' => $this->input->get_post('likeweight', true),
            'pciweight' => $this->input->get_post('pciweight', true),
            'strategicweight' => $this->input->get_post('strategicweight', true),
            'economicweight' => $this->input->get_post('economicweight', true),
            'localbenefitweight' => $this->input->get_post('localbenefitweight', true),
            'greenweight' => $this->input->get_post('greenweight', true),
            'businessweight' => $this->input->get_post('businessweight', true)
        );
        $this->input->get_post('searchtext', true);

        $data = array(
            'projects' => array(
                'rows' => $projects,
                'total_rows' => (count($projects) > 0) ? $projects[0]['row_count'] : 0,

            ),
            'details' => $forum,
            'model_obj' => $this->projects_model,
            'weights' => $weights
        );

        $this->headerdata['title'] = build_title($forum['title']);

        // Provide page analitics data for Segment Analitics
        $this->headerdata['page_analytics'] = array(
            'category' => 'Forum',
            'properties' => array(
                'Target Id' => $id,
                'Target Name' => $forum['title']
            )
        );

        // Render the page
        $this->load->view('stimulus/header_stimulus', $this->headerdata);
        $this->load->view('maps/proj_ranks', $data);
        $this->load->view('templates/footer', $this->footer_data);

    }
	
	public function exports_data($id){

	$headers = ['pid', 'slug', 'keywords', 'projectname', 'projectphoto', 'sector', 'country', 'lat', 'lng', 'Total Value', 'sponsor', 'stage', 'subsector', 'location' , 'description', 'people served', 'margingal people served', 'property value', 'CO2 Saved', 'economic impact', 'oil eliminated', 'total'];
        $array = $this->maps_model->projects($id, 'pid, p.slug, p.keywords, projectname, projectphoto, p.sector, p.country, p.lat, p.lng, p.totalbudget, p.sponsor, p.stage, p.subsector, p.location, p.description, p.people_served, p.marg_peopleserved, p.property_val, p.co2_saved, p.econ_impact, p.oil_eliminated', array('p.id' => 'random'), 700, 0, true, $filter, $sort);

        array_unshift($array , $headers);

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"test".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');

        foreach ($array as $data_array) {
            fputcsv($handle, $data_array);
        }
        fclose($handle);
        exit;
    }

    public function export_geojson($id){

        $array = $this->maps_model->get_geojson($id);

        $handle = fopen("file.txt", "w");
        fwrite($handle, $array);
        fclose($handle);

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename('file.txt'));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('file.txt'));
        readfile('file.txt');
        exit;
    }

}
