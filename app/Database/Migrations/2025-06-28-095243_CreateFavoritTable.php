<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFavoritTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'favorit_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'quote_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('favorit_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('quote_id', 'quotes', 'quote_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('favorit');
    }

    public function down()
    {
        $this->forge->dropTable('favorit');
    }
}
