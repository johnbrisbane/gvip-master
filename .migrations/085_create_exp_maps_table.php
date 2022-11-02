<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_maps_table extends CI_Migration {

    protected $table = 'exp_maps';

    public function up()
    {
        // Create exp_forums table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE'),
                'title' => array('type' => 'varchar', 'constraint' => 1024, 'null' => FALSE),
                'category_id' => array('type' => 'int', 'null' => FALSE),
                'style_url' => array('type' => 'varchar', 'constraint' => 255, 'null' => TRUE),
                'photo' => array('type' => 'varchar', 'constraint' => 255, 'null' => TRUE),
                'content' => array('type' => 'text', 'null' => TRUE),
                'status' => array('type' => 'varchar', 'constraint' => 1, 'null' => FALSE, 'default' => '0'),
                'show_geojson' => array('type' => 'varchar', 'constraint' => 1, 'null' => TRUE, 'default' => '0'),
                'created_at' => array('type' => 'timestamp', 'null' => TRUE),
                'updated_at' => array('type' => 'timestamp', 'null' => TRUE)
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table($this->table);

            $this->db->query("ALTER TABLE {$this->table} ADD CONSTRAINT {$this->table}_category_id_fkey FOREIGN KEY (category_id) REFERENCES exp_maps_categories (id)");
            $this->db->query("CREATE INDEX {$this->table}_category_id_idx ON {$this->table} (category_id)");
            $this->db->query("CREATE INDEX {$this->table}_status_idx ON {$this->table} (status)");
        }
    }

    public function down()
    {
        if ($this->db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }
}
