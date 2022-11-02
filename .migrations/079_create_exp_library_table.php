<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_library_table extends CI_Migration {

    protected $table = 'exp_library';

    public function up()
    {
        // Create exp_homepage table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE'),
                'member_id'  => array('type' => 'int', 'null' => FALSE),
                'photo' => array('type' => 'varchar', 'constraint' => 255),
                'title' => array('type' => 'varchar', 'constraint' => 255, 'null' => FALSE),
                'content' => array('type' => 'text', 'null' => TRUE),
                'status'  => array('type' => 'int', 'null' => FALSE),
                'created_at' => array('type' => 'timestamp', 'null' => TRUE),
                'updated_at' => array('type' => 'timestamp', 'null' => TRUE)

            );
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table($this->table);

            $sql = array(
                // FK for user
                "ALTER TABLE {$this->table}
                    ADD CONSTRAINT {$this->table}_member_id_fkey
                    FOREIGN KEY (member_id) REFERENCES exp_members (uid)",
                "CREATE INDEX {$this->table}_member_id_idx ON {$this->table} (member_id)",
                // Default value of NOW() for created_at
                "ALTER TABLE {$this->table} ALTER created_at SET DEFAULT CURRENT_TIMESTAMP",
            );

            $this->execute($sql);
        }
    }

    public function down()
    {
        if ($this->db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }

    private function execute($sql)
    {
        foreach ($sql as $stmt) {
            $this->db->query($stmt);
        }
    }
}
