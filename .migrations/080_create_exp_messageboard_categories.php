<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_messageboard_categories extends CI_Migration {

    protected $table = 'exp_messageboard_categories';

    public function up()
    {
        // Create exp_homepage table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE'),
                'cat_name'  => array('type' => 'varchar', 'constraint' => 255),
                'slug'  => array('type' => 'varchar', 'constraint' => 255),
                'cat_description'  => array('type' => 'varchar', 'constraint' => 255),
                'photo' => array('type' => 'varchar', 'constraint' => 255, 'null' => TRUE),
                'status'  => array('type' => 'int'),

            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', true);
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
