<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_maps_categories_table extends CI_Migration {

    protected $table = 'exp_maps_categories';

    public function up()
    {
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id'		=> array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => FALSE),
                'name'      => array('type' => 'varchar', 'constraint' => 255, 'null' => FALSE)
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table($this->table);


            $rows = array(
                array('name' => 'United States'),
                array('name' => 'Latin America'),
                array('name' => 'North America'),
                array('name' => 'Asia'),
                array('name' => 'Global')
            );
            $this->db->insert_batch($this->table, $rows);
        }
    }

    public function down()
    {
        if ($this->db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }
}
