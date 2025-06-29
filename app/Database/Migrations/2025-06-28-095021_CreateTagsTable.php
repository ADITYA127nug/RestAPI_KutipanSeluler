<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tag_id'                 => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'kategori_tags_description' => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('tag_id', true);
        $this->forge->createTable('tags');
    }

    public function down()
    {
        $this->forge->dropTable('tags');
    }
}