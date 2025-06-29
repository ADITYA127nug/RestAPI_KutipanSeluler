<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFavoritTable extends Migration
{
   public function up()
    {
        $this->forge->addField([
            'favori_id'   => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'unsigned' => true],
            'author_id'   => ['type' => 'INT', 'unsigned' => true],
            'quote_id'    => ['type' => 'INT', 'unsigned' => true],
            'date_added'  => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('favori_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('author_id', 'authors', 'author_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('quote_id', 'quotes', 'quote_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('favorit');
    }

    public function down()
    {
        $this->forge->dropTable('favorit');
    }
}