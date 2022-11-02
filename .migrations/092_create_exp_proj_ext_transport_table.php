<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_proj_ext_transport_table extends CI_Migration {

    protected $table = 'exp_proj_ext_transport';

    public function up()
    {
        // Create exp_forums table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE'),
                'slug' => array('type' => 'text', 'null' => TRUE),
                'uid' => array('type' => 'int', 'null' => TRUE),
                'miles' => array('type' => 'int', 'null' => TRUE),
                'add_riders' => array('type' => 'int', 'null' => TRUE),
                'add_goods' => array('type' => 'int', 'null' => TRUE),
                'vmt' => array('type' => 'int', 'null' => TRUE),
                'avg_ridership' => array('type' => 'int', 'null' => TRUE),
                'capacity_added' => array('type' => 'int', 'null' => TRUE),
            );

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table($this->table);

        }
    }

    public function down()
    {
        if ($this->db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }
}