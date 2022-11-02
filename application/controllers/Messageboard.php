<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Messageboard extends CI_Controller {

    //public class variables
    protected $headerdata = array();
    protected $footer_data = array();

    public function __construct() {

        parent::__construct();

        $languageSession = sess_var('lang');
        get_language_file($languageSession);

        //Load the default model for this controller
        $this->load->model('messageboard_model');

        // Load breadcrumb library
        $this->load->library('breadcrumb');

        // Set Header Data for this page like title,bodyid etc
        $this->headerdata['bodyid'] = 'messageboard';
        $this->headerdata['bodyclass'] = '';
        $this->headerdata['title'] = 'Message Board';

        $this->output->enable_profiler(FALSE);

        $this->footer_data['lang'] = langGet();

        //load form_validation library for default validation methods
        $this->load->library('form_validation');

    }

    public function index()
    {

        $categories = $this->messageboard_model->get_categories();
        $totalposts = $this->messageboard_model->total_posts();

        $data = array(
            'categories' => $categories,
            'totalposts' => $totalposts
        );


        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('messageboard/index', $data);
        $this->load->view('templates/footer', $this->footer_data);
    }

    public function category_view($category){

        $cat_id = $this->messageboard_model->get_cat_id_from_slug($category);

        // If we can't find a forum redirect to the forums list view
        if (empty($cat_id)) {
            redirect('messageboard', 'refresh');
            exit;
        }


        $cat = $this->messageboard_model->get_from_slug($category, 'id, cat_name, slug', 'exp_messageboard_categories');
        $total_topics = $this->messageboard_model->get_counters($cat['id'],'topic_cat', 'exp_messageboard_topics');
        $topics = $this->messageboard_model->get_topics($cat_id);


        $data = array(
            'category' => $cat,
            'topics' => $topics,
            'total_topics' => $total_topics,
        );


        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('messageboard/category_view', $data);
        $this->load->view('templates/footer', $this->footer_data);
    }

    public function create_category(){

        // If the user is not logged in then redirect to the login page
        auth_check();

        if ($this->input->post('create_category')) {
            $this->form_validation->set_rules('title', 'Title of Category', 'trim|required');
            $this->form_validation->set_rules('desc', 'Description of Category', 'trim|required');
            if ($this->form_validation->run() === true) {

                $cat_name = $this->input->post('title', true);
                $cat_desc = $this->input->post('desc', true);

                // add_category() method from messageboard Model to add category
                if ($cat_id = $this->messageboard_model->add_category($cat_name, $cat_desc)) {

                    // Analytics
                    $page_analytics = array(
                        'event' => array(
                            'name' => 'Category Created',
                            'properties' => array(
                                'Category Id' => (int) $cat_id,
                                'Category Name' => $cat_name
                            )
                        )
                    );
                    // Set flash data before redirect
                    $this->session->set_flashdata('page_analytics', $page_analytics);

                    //redirect to the newly created project edit page
                    redirect("/messageboard", 'refresh');
                }
            }
        }

        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('messageboard/create_category');
        $this->load->view('templates/footer', $this->footer_data);

    }

    public function create_topic($category){

        // If the user is not logged in then redirect to the login page
        auth_check();

        $id = $this->messageboard_model->get_cat_id_from_slug($category);

        if ($this->input->post('create_topic')) {
            $this->form_validation->set_rules('title', 'Title of Topic', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($this->form_validation->run() === true) {

                $top_title = $this->input->post('title', true);
                $message = $this->input->post('message', true);

                // add_category() method from messageboard Model to add category
                if ($top_id = $this->messageboard_model->add_topic($top_title, $message, $id, Auth::id())) {
                    // Retrieve a slug for the project
                    $top_slug = $this->messageboard_model->find($top_id, 'slug', 'exp_messageboard_topics');

                    // Analytics
                    $page_analytics = array(
                        'event' => array(
                            'name' => 'Category Created',
                            'properties' => array(
                                'Category Id' => (int) $top_id,
                                'Category Name' => $top_title
                            )
                        )
                    );
                    // Set flash data before redirect
                    $this->session->set_flashdata('page_analytics', $page_analytics);

                    //redirect to the newly created topic page
                    redirect("/messageboard/".$category."/".$top_id, 'refresh');
                }
            }
        }

        $data = array(
            'category' => $category,
        );

        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('messageboard/create_topic', $data);
        $this->load->view('templates/footer', $this->footer_data);

    }

    public function topic_view($top_id){

        // If we can't find a topic redirect to the categories list view
        if (empty($top_id)) {
            show_404();
            exit;
        }

        $topic_data = $this->messageboard_model->find($top_id, null, 'exp_messageboard_topics');
        $topic_user_data = $this->messageboard_model->get_user_info_single($top_id, 'exp_messageboard_topics');
        $posts = $this->messageboard_model->get_posts($top_id);
        $category_data = $this->messageboard_model->find($topic_data['topic_cat'], null, 'exp_messageboard_categories');

        $data = array(
            'topic' => $topic_data,
            'posts' => $posts,
            'category' => $category_data,
            'topic_user' => $topic_user_data
        );


        //create post
        if ($this->input->post('create_post')) {
            // If the user is not logged in then redirect to the login page
            auth_check();
            $this->form_validation->set_rules('post_content', 'Content', 'trim|required');
            if ($this->form_validation->run() === true) {

                $content = $this->input->post('post_content', true);

                if ($post_id = $this->messageboard_model->add_post($content, $top_id, Auth::id())) {

                    // Analytics
                    $page_analytics = array(
                        'event' => array(
                            'name' => 'Post Created',
                            'properties' => array(
                                'Post Id' => (int) $post_id,
                                'Post Content' => $content
                            )
                        )
                    );
                    // Set flash data before redirect
                    $this->session->set_flashdata('page_analytics', $page_analytics);

                    //redirect to the topic page
                    redirect("/messageboard/".$category_data['slug']."/".$top_id, 'refresh');
                }
            }
        }

        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('messageboard/topic_view', $data);
        $this->load->view('templates/footer', $this->footer_data);

    }

    public function delete_category($cat_id)
    {


        if (in_array(Auth::id(), INTERNAL_USERS)) {

            if ($this->messageboard_model->delete_category($cat_id)) {
                redirect("messageboard", 'refresh');
            } else {
                sendResponse(array(
                    'status' => 'success',
                    'msgtype' => 'error',
                    'msg' => 'Error while deleting Category.'
                ));
            }

        }
        else{
            redirect("/messageboard/", 'refresh');
        }
    }

    public function delete_topic($top_id){

        $uid = $this->messageboard_model->find($top_id, 'member_id', 'exp_messageboard_topics');
        $member_id = $uid['member_id'];

        if (in_array(Auth::id(), INTERNAL_USERS) || Auth::id() == $member_id) {

            if ($this->messageboard_model->delete_topic($top_id)) {
                redirect("messageboard", 'refresh');
            } else {
                sendResponse(array(
                    'status' => 'success',
                    'msgtype' => 'error',
                    'msg' => 'Error while deleting Category.'
                ));
            }

        }
        else{
            redirect("/messageboard/", 'refresh');
        }
    }

    public function delete_post($post_id){

        $uid = $this->messageboard_model->find($post_id, 'member_id', 'exp_messageboard_posts');
        $member_id = $uid['member_id'];

        if (in_array(Auth::id(), INTERNAL_USERS) || Auth::id() == $member_id) {

            if ($this->messageboard_model->delete_post($post_id)) {
                redirect("messageboard", 'refresh');
            } else {
                sendResponse(array(
                    'status' => 'success',
                    'msgtype' => 'error',
                    'msg' => 'Error while deleting Category.'
                ));
            }

        }
        else{
            redirect("/messageboard/", 'refresh');
        }


    }
}
