<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthorsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'author_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'author_name'     => ['type' => 'VARCHAR', 'constraint' => '150'],
            'author_email'    => ['type' => 'VARCHAR', 'constraint' => '150', 'unique' => true],
            'author_photo'    => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'description'     => ['type' => 'TEXT', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('author_id', true);
        $this->forge->createTable('authors');
    }

    public function down()
    {
        $this->forge->dropTable('authors');
    }
}
