<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_proj_ext_IT_table extends CI_Migration {

    protected $table = 'exp_proj_ext_IT';

    public function up()
    {
        // Create exp_forums table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE'),
                'slug' => array('type' => 'text', 'null' => TRUE),
                'uid' => array('type' => 'int', 'null' => TRUE),
                'mb_per_sec' => array('type' => 'int', 'null' => TRUE),

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