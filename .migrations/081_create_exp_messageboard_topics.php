<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_messageboard_topics extends CI_Migration {

    protected $table = 'exp_messageboard_topics';

    public function up()
    {
        // Create exp_homepage table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE', 'unique' => TRUE),
                'member_id'  => array('type' => 'int'),
                'topic_subject' => array('type' => 'varchar', 'constraint' => 255),
                'message'  => array('type' => 'text'),
                'topic_cat' => array('type' => 'int'),
                'photo' => array('type' => 'varchar', 'constraint' => 255, 'null' => TRUE),
                'status'  => array('type' => 'int'),
                'created_at' => array('type' => 'timestamp', 'null' => TRUE),
                'slug'  => array('type' => 'varchar', 'constraint' => 255)

            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table($this->table);

            $sql = array(
                // FK for user
                "ALTER TABLE {$this->table}
                    ADD CONSTRAINT {$this->table}_member_id_fkey
                    FOREIGN KEY (member_id) REFERENCES exp_members (uid)",
                "CREATE INDEX {$this->table}_member_id_idx ON {$this->table} (member_id)",
                // FK for topic cat
                "ALTER TABLE {$this->table}
                    ADD CONSTRAINT {$this->table}_topic_cat_fkey
                    FOREIGN KEY (topic_cat) REFERENCES exp_messageboard_topics (id)",
                "CREATE INDEX {$this->table}_topic_cat_idx ON {$this->table} (topic_cat)",
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
