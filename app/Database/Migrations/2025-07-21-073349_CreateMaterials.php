<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaterials extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'user_id'      => ['type' => 'INT', 'unsigned' => true],
            'title'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'  => ['type' => 'TEXT', 'null' => true],
            'type'         => [
                'type'       => 'ENUM',
                'constraint' => ['artikel', 'image', 'ebook', 'audio', 'video'],
                'null'       => false,
            ],
            'file_path'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'thumbnail'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_approved'  => ['type' => 'TINYINT', 'default' => 0],
            'approved_at'  => ['type' => 'DATETIME', 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true]
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
