<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_maps_styles_table extends CI_Migration {

    protected $table = 'exp_maps_styles';

    public function up()
    {
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id'		=> array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => FALSE),
                'name'      => array('type' => 'varchar', 'constraint' => 255, 'null' => FALSE),
                'style'      => array('type' => 'varchar', 'constraint' => 255, 'null' => FALSE)
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