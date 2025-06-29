<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuotesTable extends Migration
{
   public function up()
    {
        $this->forge->addField([
            'quote_id'      => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'author_id'     => ['type' => 'INT', 'unsigned' => true],
            'user_id'       => ['type' => 'INT', 'unsigned' => true],
            'kategori_id'   => ['type' => 'INT', 'unsigned' => true],
            'quotes_photo'  => ['type' => 'VARCHAR', 'constraint' => '255'],
            'quotes_title'  => ['type' => 'VARCHAR', 'constraint' => '255'],
            'quotes_comment'=> ['type' => 'VARCHAR', 'constraint' => '255'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('quote_id', true);
        $this->forge->addForeignKey('author_id', 'authors', 'author_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kategori_id', 'quotes_kategori', 'kategori_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('quotes');
    }

    public function down()
    {
        $this->forge->dropTable('quotes');
    }
}