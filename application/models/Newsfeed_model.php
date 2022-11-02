<?php
class Newsfeed_model extends CI_Model {

    /**
     * Return an array of videos
     *
     * @param array $where
     * @param string $select
     * @param string|array $order_by
     * @param int $limit
     * @return array
     */
    public function all($where = null, $select = null, $order_by = null, $limit = null)
    {
            $select = 'id, link, thumbnail, title, description, category,
        created_at';

        $this->base_query($select, $where, $order_by);

        $rows = $this->db
            ->get()
            ->result_array();

        foreach($rows as $row){
            $row['created_at'] = $this->cleanDate($row['created_at']);
            $result[] = $row;
        }

        return $result;
    }

    /**
     * Generates a base query for forums
     *
     * @param string $select
     * @param array $where
     * @param string|array $order_by
     * @param bool $row_count
     * @return void
     */
    private function base_query($select = null, $where = null, $order_by = null, $row_count = false)
    {
        $select = (! is_null($select)) ? $select : $this->select;
        $this->db
            ->from('exp_gviptv')
            ->select($select);

        $this->apply_where($where);


        if ($row_count) {
            $this->db->select('COUNT(*) OVER () AS row_count', false);
        }
    }

    /**
     * Receives an array of conditions and applies the to ORDER BY clause of the current query
     *
     * @param array $order_by
     * @return void
     */
    private function apply_order_by($order_by)
    {
        if (! is_null($order_by) && is_array($order_by)) {
            foreach ($order_by as $column => $direction) {
                $this->db->order_by($column, $direction);
            }
        }
    }

    /**
     * Receives an array of conditions and applies them to WHERE clause of the current query
     *
     * @param array $where
     * @return void
     */
    private function apply_where($where)
    {
        if (! is_null($where) && is_array($where)) {
            foreach ($where as $column => $value) {
                // If the key is of type int that means that it is a RAW WHERE clause.
                // Therefore we need to apply it as such
                if (is_int($column)) {
                    $this->db->where($value, null, false);
                } else {
                    $this->db->where($column, $value);
                }
            }
        }
    }


    public function allprojets($limit, $offset = 0, $filter = array(), $sort = null)
    {
        $this->db
            ->select('p.pid, p.uid, projectname, slug, projectphoto, p.country, p.sector, p.subsector, stage, totalbudget, o.government_level, description')
            ->select('COUNT(*) OVER () row_count', FALSE)
            ->from('exp_projects p')
            ->join('exp_members o', 'p.uid = o.uid')
            ->where('isdeleted', '0')
            ->where('projectphoto is not null')
            ->where('o.status', STATUS_ACTIVE)
            ->where_in('o.membertype', array(MEMBER_TYPE_MEMBER, MEMBER_TYPE_EXPERT_ADVERT));

        if (! empty($filter['stage'])) {
            $this->db->where('stage', $filter['stage']);
        }

        if (! empty($filter['sector'])) {
            $this->db->where('p.sector', $filter['sector']);

            if (!empty($filter['subsector'])) {
                $this->db->where('p.subsector', $filter['subsector']);
            }
        }

        if (! empty($filter['country'])) {
            $this->db->where('p.country', $filter['country']);
        }

        if (! empty($filter['searchtext'])) {
            $terms = split_terms2($filter['searchtext']);

            $columns = array(
                'projectname',
                'p.country',
                'p.description',
            );
            $where = where_like2($columns, $terms);
            $this->db->where($where, null, FALSE);
        }

        switch ($sort) {
            case 1: // alphabetical by projectname
                $this->db->order_by('projectname');
                break;
            case 3: // Most Liked
                $this->db
                    ->join("(SELECT proj_id, COUNT(proj_id) FROM exp_proj_likes
						JOIN exp_projects
						ON exp_proj_likes.proj_id = exp_projects.pid
						WHERE isdeleted = '0'
						GROUP BY proj_id
						ORDER BY COUNT(proj_id) DESC) AS update_likes", 'p.pid = update_likes.proj_id', 'left outer')
                    ->order_by('proj_id ASC');
                break;
            default: // Most recently updated first (option 2, default)
                $this->db
                    ->join("(SELECT t1.pid, t1.last_date
                            FROM log_projects AS t1
                            LEFT OUTER JOIN log_projects AS t2
                              ON t1.pid = t2.pid 
                                AND (t1.last_date < t2.last_date 
                                 OR (t1.last_date = t2.last_date AND t1.log_id < t2.log_id))
                            JOIN exp_projects proj 
                              ON (proj.pid = t1.pid) 
                            WHERE t2.pid IS NULL
                              AND proj.isdeleted = '0'
                            ORDER BY t1.last_date DESC) AS update_dates", 'p.pid = update_dates.pid', 'left outer')
                    ->order_by('(CASE WHEN last_date IS NULL THEN 1 ELSE 0 END)')
                    ->order_by('last_date DESC');
                break;

        }

        $rows = $this->db
            ->limit($limit, $offset)
            ->get()
            ->result_array();

        return $rows;

    }


    /**
     * Does user Like project
     *
     * @param int $proj_id
     * @param int $follower It's uid from exp_members
     * @return bool
     */
    public function is_liked($proj_id, $follower)
    {

        $checklikes = $this->db->query('select * from exp_proj_likes where proj_id=\''.$proj_id.'\' 
                                    and rated_by=\''.$follower.'\'');
        $resultchecklikes = $checklikes->num_rows();

        if ($resultchecklikes == 1){
            return true;
        }
        else {
            return false;
        }

    }


    /**
     * Create a new like record(s)
     *
     * @param int $proj_id
     * @return bool
     */
    public function get_likes($proj_id)
    {

        $checklikes = $this->db->query('select * from exp_proj_likes where proj_id=\''.$proj_id.'\' 
                                    and proj_id=\''.$proj_id.'\'');
        $resultchecklikes = $checklikes->num_rows();


        return $resultchecklikes;

    }


    /**
     * Create a new like record(s)
     *
     * @param int $proj_id
     * @param int $follower It's uid from exp_members
     * @return bool
     */
    public function saveLikes($proj_id, $follower)
    {

        $totallikes = $this->db->query('select * from exp_proj_likes where proj_id=\''.$proj_id.'\'');
        $resulttotallikes = $totallikes->num_rows();

        $checklikes = $this->db->query('select * from exp_proj_likes where proj_id=\''.$proj_id.'\' 
                                    and rated_by=\''.$follower.'\'');
        $resultchecklikes = $checklikes->num_rows();

        if($resultchecklikes == '0' ){

            $data=array('proj_id'=>$proj_id,'rated_by'=>$follower, 'isliked'=>'1');
            $this->db->insert('exp_proj_likes',$data);

        }else{
            $this->db->delete('exp_proj_likes', array('proj_id'=>$proj_id,
                'rated_by'=>$follower));
        }
        return true;

    }



    /**
     * Get paginated list of users with filters applied
     *
     * @param int $limit How many records to return starting from offset
     * @param int $offset How many records to skip
     * @param array $filter country|discipline|sector|searchtext
     * @param int $member_type
     * @param int|null $sort Prerefined sort order (1, 2, 3)
     * @return array
     */
    public function get_filter_user_list2($limit, $offset = 0, $filter = array(), $member_type = MEMBER_TYPE_MEMBER, $sort = 3) {


        $this->db->from('exp_members');
        if (! empty($filter['country'])) {
            $this->db->where('exp_members.country', $filter['country']);
        }
        if (! empty($filter['discipline'])) {
            $this->db->where('exp_members.discipline', $filter['discipline']);
        }
        if (! empty($filter['sector'])) {
            $where = " exp_members.uid IN (SELECT DISTINCT uid FROM exp_expertise_sector WHERE permission = 'All' AND status = " .
                $this->db->escape(STATUS_ACTIVE) .
                " AND sector = " . $this->db->escape($filter['sector']);
            if (! empty($filter['subsector'])) {
                $where .= " AND subsector = " . $this->db->escape($filter['subsector']);
            }
            $where .= ")";

            $this->db->where($where, null, FALSE);
        }

        if (! empty($filter['searchtext'])) {
            $terms = split_terms2($filter['searchtext']);

            $columns = array(
                'organization',
                'country',
            );
            if ($member_type == MEMBER_TYPE_MEMBER) {
                $columns = array_merge($columns, array(
                    'firstname',
                    'lastname',
                    'title'
                ));
            }

            $where = where_like2($columns, $terms);
            $this->db->where($where, null, FALSE);
        }

        $this->db
            ->join('exp_expertise_sector', "exp_members.uid = exp_expertise_sector.uid AND exp_expertise_sector.permission = 'All' AND exp_expertise_sector.status = " . $this->db->escape(STATUS_ACTIVE), 'left')
            ->join('exp_member_ratings', 'exp_member_ratings.member_id = exp_members.uid', 'left')
            ->join('exp_member_rating_details', 'exp_member_ratings.id = exp_member_rating_details.rating_id', 'left')
            ->where('exp_members.status', STATUS_ACTIVE)
            ->where('exp_members.membertype', $member_type)
            ->where('userphoto is not null')
            ->select('exp_members.uid, membertype, firstname, lastname, title, organization, userphoto, country, discipline')
            ->select("STRING_AGG(DISTINCT exp_expertise_sector.sector, ',' ORDER BY exp_expertise_sector.sector) expert_sector, COUNT(*) OVER() total_rows", FALSE)
            ->select('COALESCE(ROUND(AVG(exp_member_rating_details.rating), 1), 0.0) rating_overall, COUNT(DISTINCT exp_member_ratings.rated_by) rating_count', FALSE)
            ->group_by('exp_members.uid, membertype, firstname, lastname, title, organization, userphoto, country, discipline');

        if ($member_type == MEMBER_TYPE_MEMBER) {
            switch ($sort) {
                case 5: // Random
                    $this->db
                        ->order_by('firstname', 'RANDOM');
                    break;
                case 4: // High ranked first
                    $this->db
                        ->order_by('rating_overall DESC, rating_count DESC, firstname, lastname');
                    break;
                case 3: // Most recent first
                    $this->db
                        ->order_by('registerdate DESC, firstname, lastname');
                    break;
                case 2: // Most relevant
                    $this->db
                        ->select("CASE WHEN COALESCE(userphoto, '') = '' THEN 0 ELSE 1 END has_photo", FALSE)
                        ->order_by('has_photo DESC, registerdate DESC, firstname, lastname');
                    break;
                default: // Alphabetically
                    $this->db->order_by('firstname, lastname');
            }
        } else {
            $this->db->order_by('organization');
        }

        $rows = $this->db
            ->limit($limit, $offset)
            ->get()
            ->result_array();

        $result = array(
            'filter_total' => count($rows) > 0 ? (int) $rows[0]['total_rows'] : 0,
            'filter' => $rows
        );
//echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';
        return $result;
    }

    /**
     * Get last update
     *
     * @param int $proj_id
     * @return int
     */
    public function last_update($proj_id)
    {

        $this->db->select('pid, last_date, log_id');
        $this->db->from('log_projects');
        $this->db->where('pid=\''.$proj_id.'\'');
        $this->db->order_by('last_date DESC');
        $this->db->limit('1');

        $rows = $this->db
            ->get()
            ->result_array();

        foreach($rows as $logid){
            $log_id = $this->cleanDate($logid['last_date']);
        }

            return $log_id;
    }

    /**
     * Get last update
     *
     * @param int $uid
     * @return int
     */
    public function last_update_member($uid)
    {

        $this->db->select('uid, last_date, log_id, fields');
        $this->db->from('log_members');
        $this->db->where_not_in('fields', 'lat lng');
        $this->db->where_not_in('fields', 'salt password');
        $this->db->where('uid=\''.$uid.'\'');
        $this->db->where('fields is not null');
        $this->db->order_by('last_date DESC');
        $this->db->limit('1');

        $rows = $this->db
            ->get()
            ->result_array();

        $log_id = 0;
        foreach($rows as $logid){
            $log_id = $this->cleanDate($logid['last_date']);
        }

        return $log_id;
    }

    /**
     * Get last update
     *
     * @param int $uid
     * @return string
     */
    public function last_update_member_field($uid)
    {

        $this->db->select('uid, last_date, fields');
        $this->db->from('log_members');
        $this->db->where('uid=\''.$uid.'\'');
        $this->db->order_by('last_date DESC');
        $this->db->limit('1');

        $rows = $this->db
            ->get()
            ->result_array();

        foreach($rows as $logid){
            $field = $logid['fields'];
        }

        return $field;
    }

    private function cleanDate($date)
    {
        if ($date != "1111-11-11" && $date != "" && $date != "1111-11-11 00:00:00" ) {
            return DateFormat($date, DATEFORMAT, FALSE);
        } else {
            return "";
        }
    }

    /**
     * Return an array of videos
     *
     * @param array $where
     * @param string $select
     * @param string|array $order_by
     * @param int $limit
     * @return array
     */
    public function all_books($where = null, $select = null, $order_by = null, $limit = null)
    {
        $select = 'id, member_id, photo, title, content, created_at,
        updated_at';

        $this->base_query_books($select, $where, $order_by);

        $rows = $this->db
            ->get()
            ->result_array();
	    
	$result = array();

        foreach($rows as $row){
            $row['user'] = $this->findphoto($row['member_id']);
            $row['created_at'] = $this->cleanDate($row['created_at']);
            $row['updated_at'] = $this->cleanDate($row['updated_at']);
            $result[] = $row;
        }

        return $result;
    }

    /**
     * Generates a base query for forums
     *
     * @param string $select
     * @param array $where
     * @param string|array $order_by
     * @param bool $row_count
     * @return void
     */
    private function base_query_books($select = null, $where = null, $order_by = null, $row_count = false)
    {
        $select = (! is_null($select)) ? $select : $this->select;
        $this->db
            ->from('exp_library')
            ->select($select);

        $this->apply_where($where);


        if ($row_count) {
            $this->db->select('COUNT(*) OVER () AS row_count', false);
        }
    }

    /**
     * Retrieve a record by id
     *
     * @param $id
     * @return mixed
     */
    public function findphoto($id)
    {

        $row = $this->db
            ->where('uid', (int) $id)
            ->where('status', STATUS_ACTIVE)
            ->get('exp_members')
            ->row_array();

        return $row;
    }

}


?>
