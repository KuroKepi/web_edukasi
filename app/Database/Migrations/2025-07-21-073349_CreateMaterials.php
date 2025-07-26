<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaterials extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'SERIAL'],
            'user_id'      => ['type' => 'INT'],
            'title'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'  => ['type' => 'TEXT', 'null' => true],
            'type'         => ['type' => 'VARCHAR', 'constraint' => 20],
            'file_path'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'thumbnail'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_approved'  => ['type' => 'SMALLINT', 'default' => 0],
            'approved_at'  => ['type' => 'TIMESTAMP', 'null' => true],
            'created_at'   => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at'   => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('materials');
    }

    public function down()
    {
        $this->forge->dropTable('materials');
    }
}
