<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuotesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'quote_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'author_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'kategori_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'quotes_title'   => ['type' => 'VARCHAR', 'constraint' => '255'],
            'quotes_comment' => ['type' => 'TEXT'],
            'quotes_photo'   => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('quote_id', true);
        $this->forge->addForeignKey('author_id', 'authors', 'author_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kategori_id', 'kategori', 'kategori_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('quotes');
    }

    public function down()
    {
        $this->forge->dropTable('quotes');
    }
}