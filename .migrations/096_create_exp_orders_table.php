<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_orders_table extends CI_Migration {

    protected $table = 'exp_orders';

    public function up()
    {
        // Create exp_forums table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE'),
                'product_id' => array('type' => 'int', 'null' => FALSE),
                'buyer_name' => array('type' => 'varchar','constraint' => 50, 'null' => FALSE),
                'buyer_email' => array('type' => 'varchar','constraint' => 50, 'null' => FALSE),
                'paid_amount' => array('type' => 'varchar','constraint' => 10, 'null' => FALSE),
                'paid_amount_currency' => array('type' => 'varchar','constraint' => 10, 'null' => FALSE),
                'txn_id' => array('type' => 'varchar','constraint' => 50, 'null' => FALSE),
                'payment_status' => array('type' => 'varchar','constraint' => 25, 'null' => FALSE),
                'created_at' => array('type' => 'timestamp', 'null' => TRUE),
            );

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table($this->table);

            $this->db->query("ALTER TABLE {$this->table} ADD CONSTRAINT {$this->table}_product_id_fkey FOREIGN KEY (product_id) REFERENCES exp_products (id)");

        }
    }

    public function down()
    {
        if ($this->db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }
}