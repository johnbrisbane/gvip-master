<?php

class Messageboard_model extends CI_Model
{
    /**
     * Add New Category
     *
     * @access    public
     * @param $cat_name
     * @return    boolean/string
     */
    public function add_category($cat_name, $cat_description)
    {
        $slug = $this->create_slug($cat_name, 'exp_messageboard_categories');

        $data = array(
            'cat_name' => $cat_name,
            'slug'        => $slug,
            'status'     => '1', //sess_var('isforum'), // Most likely not used anymore
            'cat_description'  => $cat_description
        );

        if (! $this->db->insert('exp_messageboard_categories', $data)) {
            return FALSE;
        }
        $cat_id = $this->db->insert_id();

        return $cat_id;
    }

    /**
     * Create slug
     *
     * @access	public
     */
    public function create_slug($string, $table)
    {
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params['slug'] = $slug;

        while ($this->db->where($params)->get($table)->num_rows())
        {
            if (!preg_match ('/-{1}[0-9]+$/', $slug ))
            {
                $slug .= '-' . ++$i;
            }
            else
            {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params ['slug'] = $slug;
        }
        return $slug;
    }

    /**
     * Retrieving a record  by primary key
     *
     * @param int $id
     * @param null $select
     * @return array
     */
    public function find($id, $select = null, $table) {
        if (! is_null($select)) {
            $this->db->select($select);
        }

        $row = $this->db
            ->where('id', (int) $id)
            ->where('status', '1')
            ->from($table)
            ->get()
            ->row_array();

        return $row;
    }

    public function get_categories(){

        $qryexec = $this->db
            ->where('status', 1)
            ->get('exp_messageboard_categories');
        $execarr = $qryexec->result_array();
        $qryexec->free_result();

        foreach ($execarr as $cat){

            $cat['topics'] = $this->get_counters($cat['id'], 'topic_cat' , 'exp_messageboard_topics');
            $cat_data[] = $cat;
        }

        return $cat_data;

    }

    public function get_counters($val, $col_name, $table){

        $row = $this->db
            ->where($col_name, $val)
            ->where('status', '1')
            ->count_all_results($table);

        return $row;
    }

    public function get_from_slug($slug, $select = null, $table){

        if (! is_null($select)) {
            $this->db->select($select);
        }

        $row = $this->db
            ->where('slug', $slug)
            ->where('status', 1)
            ->from($table)
            ->get()
            ->row_array();

        return $row;
    }

    public function total_posts(){

        $row = $this->db
            ->where('status', '1')
            ->count_all_results('exp_messageboard_posts');

        return $row;
    }

    /**
     * Add New Topic
     *
     * @access    public
     * @param $top_title
     * @param $message
     * @param $category
     * @param $uid
     * @return    boolean/string
     */
    public function add_topic($top_title, $message, $cat_id, $uid)
    {
        $slug = $this->create_slug($top_title, 'exp_messageboard_topics');

        $data = array(
            'member_id' => $uid,
            'topic_subject'  => $top_title,
            'slug'      => $slug,
            'status'    => '1',
            'message'  => $message,
            'topic_cat' => $cat_id
        );

        if (! $this->db->insert('exp_messageboard_topics', $data)) {
            return FALSE;
        }
        $top_id = $this->db->insert_id();

        return $top_id;
    }

    public function get_topics($cat_id){

        $qryexec = $this->db
            ->select('*')
            ->from('exp_messageboard_topics')
            ->join('exp_members', 'exp_members.uid = exp_messageboard_topics.member_id')
            ->where('topic_cat', $cat_id)
            ->where('exp_messageboard_topics.status', 1)
            ->where('exp_members.status', '1')
            ->get();
        $execarr = $qryexec->result_array();
        $qryexec->free_result();


        if (!empty($execarr)){
            foreach ($execarr as $top){

                $top['posts'] = $this->get_counters($top['id'], 'post_topic' ,'exp_messageboard_posts');
                $top['created_at'] = $this->cleanDate($top['created_at']);
                $top_data[] = $top;
            }
            return $top_data;
        }
        else{
            return 0;
        }

    }

    public function get_cat_id_from_slug($slug)
    {
        $this->db->select("id");
        $qrycheck = $this->db->get_where("exp_messageboard_categories",array("slug"=>$slug,"status"=>"1"));
        if($qrycheck->num_rows() > 0)
        {
            $objproject = $qrycheck->row_array();
            $uid2 = $objproject["id"];
            return $uid2;
        }
        else
        {
            return "";
        }
    }

    public function get_posts($top_id){

        $qryexec = $this->db
            ->select('*')
            ->from('exp_messageboard_posts')
            ->join('exp_members', 'exp_members.uid = exp_messageboard_posts.member_id')
            ->where('post_topic', $top_id)
            ->where('exp_messageboard_posts.status', 1)
            ->where('exp_members.status', '1')
            ->get();
        $execarr = $qryexec->result_array();
        $qryexec->free_result();


        if (!empty($execarr)){
            foreach ($execarr as $post){

                $post['all_posts'] = $this->get_counters($top_id, 'post_topic' ,'exp_messageboard_posts');
                $post['created_at'] = $this->cleanDate($post['created_at']);
                $post_data[] = $post;
            }
            return $post_data;
        }
        else{
            return 0;
        }
    }

    public function all_posts() {
        $qryexec = $this->db
            ->where('status', 1)
            ->get('exp_messageboard_posts');
        $execarr = $qryexec->result_array();
        $qryexec->free_result();

        return $execarr;
    }

    /**
     * Add New Post
     *
     * @access    public
     * @param $content
     * @param $topic_id
     * @param $uid
     * @return    boolean/string
     */
    public function add_post($content, $topic_id, $uid)
    {
        $data = array(
            'member_id'     => $uid,
            'post_content'  => $content,
            'post_topic'    => $topic_id,
            'status'        => '1'
        );

        if (! $this->db->insert('exp_messageboard_posts', $data)) {
            return FALSE;
        }
        $post_id = $this->db->insert_id();

        return $post_id;
    }


    public function get_user_info_single($id, $table){

        $row = $this->db
            ->select('*')
            ->from($table)
            ->join('exp_members', 'exp_members.uid = ' . $table . '.member_id')
            ->where('id', $id)
            ->where('exp_members.status', '1')
            ->where($table . '.status', 1)
            ->get()
            ->row_array();

        return $row;
    }

    private function cleanDate($date)
    {
        if ($date != "1111-11-11" && $date != "" && $date != "1111-11-11 00:00:00" ) {
            return DateFormat($date, DATEFORMAT, FALSE);
        } else {
            return "";
        }
    }

    public function delete_category($id)
    {

        $data = array(
            'status' => 0
        );
        // BEGIN TRANSACCTION
        $this->db->trans_start();

        // And only now we can delete forum records themselves
        $this->db
            ->where('id', $id)
            ->update('exp_messageboard_categories', $data);

        // COMMIT
        $this->db->trans_complete();
        $this->db->trans_off(); // TODO: Revisit this

        if ($this->db->trans_status() === false) {
            return false;
        }

        return true;
    }

    public function delete_topic($id)
    {

        $data = array(
            'status' => 0
        );

        // BEGIN TRANSACCTION
        $this->db->trans_start();

        // And only now we can delete forum records themselves
        $this->db
            ->where('id', $id)
            ->update('exp_messageboard_topics', $data);

        // COMMIT
        $this->db->trans_complete();
        $this->db->trans_off(); // TODO: Revisit this

        if ($this->db->trans_status() === false) {
            return false;
        }

        return true;

    }

    public function delete_post($id){

        $data = array(
            'status' => 0
        );

        // BEGIN TRANSACCTION
        $this->db->trans_start();

        // And only now we can delete forum records themselves
        $this->db
            ->where('id', $id)
            ->update('exp_messageboard_posts', $data);

        // COMMIT
        $this->db->trans_complete();
        $this->db->trans_off(); // TODO: Revisit this

        if ($this->db->trans_status() === false) {
            return false;
        }

        return true;

    }


}
