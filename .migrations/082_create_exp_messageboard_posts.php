<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_exp_messageboard_posts extends CI_Migration {

    protected $table = 'exp_messageboard_posts';

    public function up()
    {
        // Create exp_homepage table
        if (! $this->db->table_exists($this->table)) {
            $fields = array(
                'id' => array('type' => 'SERIAL', 'auto_increment' => TRUE, 'null' => 'FALSE'),
                'member_id'  => array('type' => 'int'),
                'post_content'  => array('type' => 'text'),
                'post_topic'  => array('type' => 'int', 'constraint' => 255),
                'status'  => array('type' => 'int'),
                'created_at' => array('type' => 'timestamp', 'null' => TRUE)

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
                // FK for topic id
                "ALTER TABLE {$this->table}
                    ADD CONSTRAINT {$this->table}_post_topic_fkey
                    FOREIGN KEY (post_topic) REFERENCES exp_messageboard_topics (id)",
                "CREATE INDEX {$this->table}_post_topic_idx ON {$this->table} (post_topic)",
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
