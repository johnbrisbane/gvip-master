<?php

class Maps_model extends CI_Model
{

    /**
     * @var string
     */
    protected $select = 'f.id, title, category_id, fc.name AS category,
        style_url, photo, content, status, show_geojson';


    /**
     * @var array
     */
    protected $order_by = array(
        'created_at' => 'desc'
    );


    /**
     * Retrieving a record by primary key
     *
     * @param int $id
     * @param null $select
     * @return array
     */
    public function find($id, $select = null)
    {
        $this->base_query($select, array('f.id' => (int) $id));

        $row = $this->db
            ->get()
            ->result_array();

        if (count($row) > 0) {
            $row = $row[0];
        }

        return $row;
    }

    /**
     * Return an array of maps
     *
     * @param array $where
     * @param string $select
     * @param string|array $order_by
     * @param int $limit
     * @param int $offset
     * @param bool $row_count
     * @return array
     */
    public function all($where = null, $select = null, $order_by = null, $limit = null, $offset = null, $row_count = false)
    {
        $this->base_query($select, $where, $order_by, $row_count);

        if (! is_null($limit)) {
            $this->db->limit($limit, (! is_null($offset)) ? $offset : 0);
        }

        $rows = $this->db
            ->get()
            ->result_array();

        return $rows;
    }

    /**
     * Delete map(s) by id(s)
     *
     * @param int|array $id
     * @return bool
     */
    public function delete($id)
    {
        if (! is_array($id)) {
            $id = array($id);
        }

        // BEGIN TRANSACCTION
        $this->db->trans_start();

        // First delete experts (members) accossiated with the map
        $this->db
            ->where_in('map_id', $id)
            ->delete('exp_maps_member');
        // Then delete projects accossiated with the map
        $this->db
            ->where_in('map_id', $id)
            ->delete('exp_maps_project');
        // And only now we can delete map records themselves
        $this->db
            ->where_in('id', $id)
            ->delete('exp_maps');

        // COMMIT
        $this->db->trans_complete();
        $this->db->trans_off(); // TODO: Revisit this

        if ($this->db->trans_status() === false) {
            return false;
        }

        return true;
    }

    /**
     * @param $id
     * @param $data
     */
    public function update($id, $data)
    {
        $this->db
            ->where('id', $id)
            ->set($data)
            ->update('exp_maps');
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        $this->db
            ->set($data)
            ->insert('exp_maps');
        return $this->db->insert_id();
    }

    /**
     * Associate members with the map
     *
     * @param $id
     * @param string| array $members
     * @return bool
     */
    public function add_members($id, $members)
    {
        if (is_null($members)) {
            return false;
        }

        $members = (is_array($members)) ? $members : array($members);

        if (count($members) == 0) {
            return false;
        }

        $data = array();
        foreach ($members as $member) {
            $data[] = array('map_id' => $id, 'member_id' => $member);
        }

        $this->db->insert_batch('exp_maps_member', $data);

        return true;
    }

    /**
     * Delete members associated with the map
     * !!! If an empty array is passed in $members it will delete ALL members
     *
     * @param $id
     * @param string|array $members
     * @return bool
     */
    public function delete_members($id, $members)
    {
        if (is_null($members)) {
            return false;
        }

        $members = (is_array($members)) ? $members : array($members);

        if (count($members) > 0) {
            $this->db->where_in('member_id', $members);
        }
        $this->db
            ->where('map_id', $id)
            ->delete('exp_maps_member');

        return true;
    }

    /**
     * @param $id
     * @param $members
     * @return bool
     */
    public function sync_members($id, $members)
    {
        // BEGIN TRANSACCTION
        $this->db->trans_start();

        $this->delete_members($id, array());
        $this->add_members($id, $members);

        // COMMIT
        $this->db->trans_complete();
        $this->db->trans_off(); // TODO: Revisit this

        if ($this->db->trans_status() === false) {
            return false;
        }

        return true;
    }

    /**
     * Get members (experts) along with a flag whether a member is being selected for the map
     *
     * @param $id
     * @param string $select
     * @param array $order_by
     * @param int $limit
     * @param int $offset
     * @param bool $row_count
     * @return array
     */
    public function members($id, $select = null, $order_by = null, $limit = null, $offset = null, $row_count = false)
    {
        $this->members_base_query($id, $select, null, $order_by, $row_count);

        if (! is_null($limit)) {
            $this->db->limit($limit, (! is_null($offset)) ? $offset : 0);
        }

        $rows = $this->db
            ->get()
            ->result_array();

        return $rows;
    }

    /**
     * Used for retrieving preview list of members shown on map overview page
     * Get members (experts) along with a flag whether a member is being selected for the map
     *
     * @param $id
     * @return array
     */
    public function get_members_for_map_homepage($id)
    {
        $select = "m.uid, firstname, lastname, userphoto, m.title, organization, city, state, country, lat, lng, ".
            "(CASE WHEN coalesce(userphoto, '') != '' THEN 1 ELSE 0 END) AS hasphoto, ".
            "(CASE WHEN m.uid IN (" . implode(',', INTERNAL_USERS) . ") THEN 1 ELSE 0 END) AS cglaemployee";

        $order_by = [
            'cglaemployee' => 'ASC',
            'hasphoto' => 'DESC',
            'm.id' => 'random'
        ];
        $row_count = true;

        $this->members_base_query($id, $select, null, $order_by, $row_count);


        $rows = $this->db
            ->get()
            ->result_array();


        return $rows;
    }


    /**
     * Used for retrieving preview list of members shown on map overview page
     * Get members (experts) along with a flag whether a member is being selected for the map
     *
     * @param $id
     * @return array
     */
    public function get_members_for_map_homepage_vf($id)
    {
        $select = "m.uid, firstname, lastname, userphoto, m.title, organization, country, city";

        $order_by = [
            'm.id' => 'random'
        ];
        $row_count = true;

        $this->members_base_query($id, $select, null, $order_by, $row_count);

        $rows = $this->db
            ->get()
            ->result_array();

        return $rows;
    }



    /**
     * Get ALL members (experts) along with a flag whether
     * a member is being selected (is associated with) for the map
     *
     * @param $id
     * @return mixed
     */
    public function all_members($id)
    {
        return $this->db
            ->select('uid, firstname, lastname, organization, CASE WHEN exp_maps_member.member_id IS NULL THEN 0 ELSE 1 END AS selected', false)
            ->from('exp_members')
            ->join('exp_maps_member', 'exp_maps_member.member_id = exp_members.uid AND exp_maps_member.map_id = ' . $this->db->escape($id), 'left')
            ->where('exp_members.membertype', MEMBER_TYPE_MEMBER)
            ->where('status', STATUS_ACTIVE) // Only members that are not deleted
            ->order_by('lastname')
            ->order_by('firstname')
            ->get()
            ->result_array();
    }

    /**
     * Associate projects with the map
     *
     * @param $id
     * @param string|array $projects
     * @return bool
     */
    public function add_projects($id, $projects)
    {
        if (is_null($projects)) {
            return false;
        }

        $projects = (is_array($projects)) ? $projects : array($projects);

        if (count($projects) == 0) {
            return false;
        }

        $data = array();
        foreach ($projects as $project) {
            $data[] = array('map_id' => $id, 'project_id' => $project);
        }

        $this->db->insert_batch('exp_maps_project', $data);

        return true;
    }

    /**
     * Delete projects associated with the map
     * !!! If an empty array is passed in $projects it will delete ALL projects
     *
     * @param $id
     * @param string|array $projects
     * @return bool
     */
    public function delete_projects($id, $projects = null)
    {
        if (is_null($projects)) {
            return false;
        }

        $projects = (is_array($projects)) ? $projects : array($projects);

        if (count($projects) > 0) {
            $this->db->where_in('project_id', $projects);
        }
        $this->db
            ->where('map_id', $id)
            ->delete('exp_maps_project');

        return true;
    }

    /**
     * @param $id
     * @param $projects
     * @return bool
     */
    public function sync_projects($id, $projects)
    {
        // BEGIN TRANSACCTION
        $this->db->trans_start();

        $this->delete_projects($id, array());
        $this->add_projects($id, $projects);

        // COMMIT
        $this->db->trans_complete();
        $this->db->trans_off(); // TODO: Revisit this

        if ($this->db->trans_status() === false) {
            return false;
        }

        return true;
    }

    /**
     * Get projects along with a flag whether a member is being selected for the map
     *
     * @param $id
     * @param string $select
     * @param array $order_by
     * @param int $limit
     * @param int $offset
     * @param bool $row_count
     * @param array $filter
     * @param array $sort
     * @return array
     */
    public function projects($id, $select = null, $order_by = null, $limit = null, $offset = null, $row_count = false, $filter = null, $sort = null)
    {
        $this->projects_base_query($id, $select, null, $order_by, $row_count, $filter, $sort);

        if (! is_null($limit)) {
            $this->db->limit($limit, (! is_null($offset)) ? $offset : 0);
        }

        $rows = $this->db
            ->get()
            ->result_array();

        return $rows;
    }


    /**
     * Get ALL projects along with a flag whether a project is being selected for the map
     *
     * @param $id
     * @return mixed
     */
    public function all_projects($id)
    {
        $result = $this->db
            ->select('pid, projectname, CASE WHEN fp.project_id IS NULL THEN 0 ELSE 1 END AS selected', false)
            ->from('exp_projects p')
            ->join('exp_members m', 'p.uid = m.uid')
            ->join('exp_maps_project fp', 'fp.project_id = p.pid AND fp.map_id = ' . $this->db->escape($id), 'left')
            ->where('p.isdeleted !=', '1')
            ->where('m.status', STATUS_ACTIVE) // Only projects which project owners are not deleted
            ->order_by('p.projectname')
            ->get()
            ->result_array();
        return $result;
    }

    /**
     * Returns an array of map categories
     *
     * @return array
     */
    public function categories()
    {
        $result =  $this->db
            ->select('id, name')
            ->order_by('name')
            ->get('exp_maps_categories')
            ->result_array();

        return $result;
    }

    /**
     * Returns an array of categories (regions) along with maps
     *
     * @param int $except
     * @return array
     */
    public function all_by_categories($except = null)
    {
        $join = 'fc.id = f.category_id AND f.status = ' . $this->db->escape(STATUS_ACTIVE);
        if (! is_null($except)) {
            $join .= ' AND f.id <> ' . $this->db->escape((int) $except);
        }

        $rows =  $this->db
            ->select('fc.id, fc.name category')
            ->select("STRING_AGG(f.id || '|' || f.title, ',' ORDER BY created_at DESC, updated_at DESC, f.title) maps", false)
            ->from('exp_maps_categories fc')
            ->join('exp_maps f', $join, 'left')
            ->group_by('fc.id, name')
            ->order_by('fc.id')
            ->get()
            ->result_array();

        foreach ($rows as &$row) {
            if (! is_null($row['maps'])) {
                $maps = explode(',', $row['maps']);
                $result = array();
                foreach ($maps as $map) {
                    list($id, $title) = array_map('trim', explode('|', $map));
                    $result[] = compact('id', 'title');
                }
                $row['maps'] = $result;
            } else {
                $row['maps'] = array();
            }
        }

        return $rows;
    }

    /**
     * Generates a base query for maps
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
            ->from('exp_maps f')
            ->join('exp_maps_categories fc', 'f.category_id = fc.id')
            ->select($select);

        $this->apply_where($where);

        $order_by = (! is_null($order_by)) ? $order_by : $this->order_by;
        $this->apply_order_by($order_by);

        if ($row_count) {
            $this->db->select('COUNT(*) OVER () AS row_count', false);
        }
    }



    /**
     * Get paginated list of users associated with a map, with filters applied
     *
     * @param int $id ID of the map
     * @param int $limit How many records to return starting from offset
     * @param int $offset How many records to skip
     * @param array $filter country|discipline|sector|searchtext
     * @param int $member_type
     * @param int|null $sort Prerefined sort order (TODO implement this in the future)
     *
     * @return array
     */
    public function get_filtered_user_list($id, $limit, $offset = 0, $filter = array(), $member_type = MEMBER_TYPE_MEMBER, $sort = null)
    {
        $rowc = true;
        $select = 'm.uid, firstname, lastname, organization, m.title, userphoto, country, sector, discipline';
        $this->members_base_query($id, $select, null, null, $rowc);

        $this->add_filters($filter);
        $this->db->group_by('m.uid');

        $rows = $this->db
            ->limit($limit, $offset)
            ->get()
            ->result_array();

        $result = array(
            'filter_total' =>count($rows) > 0 ? (int) $rows[0]['row_count'] : 0,
            'filter' => $rows
        );

        return $result;
    }

    private function add_filters($filter)
    {
        if (!empty($filter['country'])) {
            $this->db->where('m.country', $filter['country']);
        }
        if (! empty($filter['sector'])) {
            $where = " m.uid IN (SELECT DISTINCT uid FROM exp_expertise_sector WHERE permission = 'All' AND status = " .
                $this->db->escape(STATUS_ACTIVE) .
                " AND sector = " . $this->db->escape($filter['sector']);
            if (! empty($filter['subsector'])) {
                $where .= " AND subsector = " . $this->db->escape($filter['subsector']);
            }
            $where .= ")";

            $this->db->where($where, null, false);
        }
        if (!empty($filter['discipline'])) {
            $this->db->where('m.discipline', $filter['discipline']);
        }

        if (! empty($filter['searchtext'])) {
            $terms = split_terms2($filter['searchtext']);
            $columns = array(
                'organization',
                'firstname',
                'lastname',
                'm.title'
            );
            $where = where_like2($columns, $terms);
            $this->db->where($where);
        }
    }

    /**
     * Generates a base query for map members
     *
     * @param $id
     * @param null $select
     * @param null $where
     * @param null $order_by
     * @param bool $row_count
     *
     * @return void
     */
    private function members_base_query($id, $select = null, $where = null, $order_by = null, $row_count = false)
    {
        $this->db
            ->from('exp_maps_member fm')
            ->join('exp_maps f', 'fm.map_id = f.id')
            ->join('exp_members m', 'fm.member_id = m.uid');

        if (is_null($select)) {
            $select = 'uid, firstname, lastname, organization, m.title, userphoto';
            $this->db->select($select);
        } else {
            if (stripos($select, 'sector') !== false) {
                // Adding a little bit of automagic here in order to avoid creating a seperate method
                // If **sector** is specified as one of the columns for select then we need to fetch
                // related records from exp_expertise_sector table which requires an additional
                // LEFT JOIN, GROUP BY and the usage of STRING_AGG in select

                // Split a string of column names into an array, trim values and filter out sector
                // Will use that list of columns building a SELECT and GROUP BY clauses of the query
                $columns = array_diff(array_map('trim', explode(',', $select)), array('sector'));
                $this->db
                    ->select(implode(',', $columns)) // Let CI to escape all columns except sector
                    ->select("STRING_AGG(DISTINCT s.sector, ',' ORDER BY s.sector) sector", false) // Now we add and expression for sector
                    ->join('exp_expertise_sector s', "m.uid = s.uid AND s.permission = 'All' AND s.status = " . $this->db->escape(STATUS_ACTIVE), 'left')
                    ->group_by(implode(',', $columns)); // And use column list for GROUP BY
            } else {
                $this->db->select($select, false);
            }
        }
        $defaut_where = array(
            'f.id' => $id,
            'm.membertype' => 5,
            'm.status' => STATUS_ACTIVE
        );
        $where = (! is_null($where)) ? array_merge($defaut_where, $where) : $defaut_where;
        $this->apply_where($where);

        $order_by = (! is_null($order_by)) ? $order_by : array('firstname' => 'asc', 'lastname' => 'asc');
        $this->apply_order_by($order_by);

        if ($row_count) {
            $this->db->select('COUNT(*) OVER () AS row_count', false);
        }
    }

    /**
     * Generates a base query for map projects
     *
     * @param $id
     * @param null $select
     * @param null $where
     * @param null $order_by
     * @param bool $row_count
     * @param null $filter
     * @param null $sort
     * @return void
     */
    private function projects_base_query($id, $select = null, $where = null, $order_by = null, $row_count = false, $filter = null, $sort = null)
    {
        $select = (! is_null($select)) ? $select : 'pid, projectname';
        $this->db
            ->from('exp_maps_project fp')
            ->join('exp_maps f', 'fp.map_id = f.id')
            ->join('exp_projects p', 'fp.project_id = p.pid')
            ->join('exp_members m', 'p.uid = m.uid')
            ->select($select);

        if (! empty($filter['stage'])) {
            $this->db->where('stage', $filter['stage']);
        }

        if (! empty($filter['sector'])) {
            if ($filter['sector'] == 'Space'){

                $this->db->where('p.sector', 'Information & Communication Technologies');
                $this->db->where('p.subsector', 'Other');

            }
            else {
                $this->db->where('p.sector', $filter['sector']);

                if (!empty($filter['subsector'])) {
                    $this->db->where('p.subsector', $filter['subsector']);
                }
            }
        }

        if (! empty($filter['country'])) {
            $this->db->where('p.country', $filter['country']);
        }

        if (! empty($filter['state'])) {
            $this->db->like('keywords', $filter['state']);
        }

        if (! empty($filter['searchtext'])) {
            $terms = split_terms2($filter['searchtext']);

            $columns = array(
                'projectname',
                'p.country',
                'p.description',
            );
            $where1 = where_like2($columns, $terms);
            $this->db->where($where1, null, FALSE);
        }

        $defaut_where = array(
            'f.id' => $id,
            'p.isdeleted' => '0',
            'm.status' => STATUS_ACTIVE
        );
        $where = (! is_null($where)) ? array_merge($defaut_where, $where) : $defaut_where;
        $this->apply_where($where);


        if ($row_count) {
            $this->db->select('COUNT(*) OVER () AS row_count', false);
        }

        switch ($sort) {
            case 1: // alphabetical by projectname
                $this->db->order_by('projectname');
                break;
            case 2:
                $this->db->order_by('p.totalbudget', 'DESC');
                break;
            case 3:
                $this->db->order_by('p.totalbudget', 'RANDOM');
                break;
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

    public function has_access_to($uid, $map_id)
    {
        // Only CG/LA employees have access to the Emergency Projects list for Trump
        if ($map_id === EMERGENCY_PROJECTS_FORUM_ID && !in_array($uid, INTERNAL_USERS)) {
            return false;
        }
        if ($map_id === 37 && !in_array($uid, INTERNAL_USERS)) {
            return false;
        }

        return true;
    }
    
    /**
     * Returns an array of map styles
     *
     * @return array
     */
    public function styles()
    {
        $result =  $this->db
            ->select('id, name, style')
            ->order_by('name')
            ->get('exp_maps_styles')
            ->result_array();

        return $result;
    }

    public function get_geojson($id){

        // Fetch projects and members (experts) accociated with the map
        $projects = $this->projects($id, 'pid, p.slug, projectname, projectphoto, p.keywords, p.sector, p.country, p.lat, p.lng, p.totalbudget, p.sponsor, p.stage, p.subsector, p.location, p.description', array('p.id' => 'random'), 700, 0, false);

        $features = array();
        foreach($projects as $project => $orgexp)
        {
            $features[] = array(
                'type' => 'Feature',
                'properties' => array('slug' => $orgexp['slug'], 'location'=> $orgexp['location'], 'description'=> $orgexp['description'], 'projectname'=> $orgexp['projectname'], 'sector'=> $orgexp['sector'], 'stage'=> $orgexp['stage'], 'sponsor'=> $orgexp['sponsor'], 'subsector'=> $orgexp['subsector'], 'country'=> $orgexp['country'], 'totalbudget'=> $orgexp['totalbudget']),
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        $orgexp['lng'] + (rand(-1000,1000)*.00001),
                        $orgexp['lat'] + (rand(-1000,1000)*.00001),
                        1
                    ),
                ),
            );
        }
        $new_data = array(
            'type' => 'FeatureCollection',
            'features' => $features,
        );
        return json_encode($new_data, JSON_PRETTY_PRINT);

    }
}

