<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthorsTable extends Migration
{
<<<<<<< HEAD
     public function up()
    {
        $this->forge->addField([
            'author_id'       => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'author_name'     => ['type' => 'VARCHAR', 'constraint' => '255'],
            'author_email'    => ['type' => 'VARCHAR', 'constraint' => '255', 'unique' => true],
            'author_password' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'quotes_photo'    => ['type' => 'VARCHAR', 'constraint' => '255'],
            'quotes_title'    => ['type' => 'VARCHAR', 'constraint' => '255'],
            'description'     => ['type' => 'VARCHAR', 'constraint' => '255'],
            'kategori'        => ['type' => 'VARCHAR', 'constraint' => '255'],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('author_id', true);
        $this->forge->createTable('authors');
    }
=======
    public function up()
{
    $this->forge->addField([
        'author_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'author_name'     => ['type' => 'VARCHAR', 'constraint' => '150'],
        'author_email'    => ['type' => 'VARCHAR', 'constraint' => '150', 'unique' => true],
        'author_password' => ['type' => 'VARCHAR', 'constraint' => 255], // 🟡 Tambahkan ini
        'author_photo'    => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
        'description'     => ['type' => 'TEXT', 'null' => true],
        'created_at'      => ['type' => 'DATETIME', 'null' => true],
        'updated_at'      => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('author_id', true);
    $this->forge->createTable('authors');
}

>>>>>>> b5d9b63d889fcea0773916f26398181fca7aab2b

    public function down()
    {
        $this->forge->dropTable('authors');
    }
}