<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_exp_projects_table extends CI_Migration {

    protected $table = 'exp_projects';

    public function up()
    {
        $sql = array(
            "ALTER TABLE {$this->table} ADD people_served int NULL",
            "ALTER TABLE {$this->table} ADD marg_peopleserved int NULL",
            "ALTER TABLE {$this->table} ADD property_val int NULL",
            "ALTER TABLE {$this->table} ADD co2_saved int NULL",
            "ALTER TABLE {$this->table} ADD econ_impact int NULL",
            "ALTER TABLE {$this->table} ADD oil_eliminated int NULL",
        );

        $this->execute($sql);
    }

    public function down()
    {
        $sql = array(
            "ALTER TABLE {$this->table} DROP IF EXISTS peopleserved",
            "ALTER TABLE {$this->table} DROP IF EXISTS marg_peopleserved",
            "ALTER TABLE {$this->table} DROP IF EXISTS propertyval",
            "ALTER TABLE {$this->table} DROP IF EXISTS co2_saved",
            "ALTER TABLE {$this->table} DROP IF EXISTS econbenefits",
            "ALTER TABLE {$this->table} DROP IF EXISTS oil_eliminated",
        );

        $this->execute($sql);
    }

    private function execute($sql) {
        foreach ($sql as $stmt) {
            $this->db->query($stmt);
        }
    }
    
}