<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends CI_Controller {

    //public class variables
    public $headerdata 	= array();
    public $uid			= '';
    public $dataLang 	= array();

    public function __construct() {

        parent::__construct();

        $languageSession = sess_var('lang');
        get_language_file($languageSession);
        $this->dataLang['lang'] = langGet();

        // If the user is not logged in then redirect to the login page
        auth_check();

        //load breadcrumb library
        $this->load->library('breadcrumb');

        //Set Header Data for this page like title,bodyid etc
        $this->uid = sess_var('uid');

        $this->headerdata = array(
            'bodyid' => 'jobs',
            'bodyclass' => '',
            'title' => build_title(lang('jobs'))
        );

    }

    public function index() {

        $this->load->model('forums_model');
        $id = 37;
        $array = $this->forums_model->projects($id, 'p.sector, p.lat, p.lng, p.totalbudget, p.subsector', array('p.id' => 'random'), 20, 0, false);

        $data = array(
            'allProj' => $array,
        );

        // Render HTML Page from view direcotry
        $this->load->view('jobs/index', $data);

    }
}
