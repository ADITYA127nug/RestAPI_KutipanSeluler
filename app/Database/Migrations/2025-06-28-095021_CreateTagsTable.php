<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTagsTable extends Migration
{
   public function up()
    {
        $this->forge->addField([
            'tag_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tag_name' => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
        ]);
        $this->forge->addKey('tag_id', true);
        $this->forge->createTable('tags');
    }

    public function down()
    {
        $this->forge->dropTable('tags');
    }
}
