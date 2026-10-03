<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 120],
            'location' => ['type' => 'VARCHAR', 'constraint' => 120],
            'difficulty' => ['type' => 'ENUM', 'constraint' => ['Easy', 'Moderate', 'Hard']],
            'distance_km' => ['type' => 'DECIMAL', 'constraint' => '6,2'],
            'description' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('trails');
    }

    public function down()
    {
        $this->forge->dropTable('trails');
    }
}
