<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_products_table extends CI_Migration {

    protected $table = 'exp_products';

    public function up()
    {
        // Create exp_forums table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE'),
                'title' => array('type' => 'varchar', 'constraint' => 255, 'null' => FALSE),
                'price' => array('type' => 'float', 'null' => FALSE, 'default' => '0.00'),
                'currency' => array('type' => 'char','constraint' => 10, 'null' => FALSE),
                'status' => array('type' => 'varchar', 'constraint' => 1, 'null' => FALSE, 'default' => '0'),
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