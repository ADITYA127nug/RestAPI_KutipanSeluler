<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuotesTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'quote_id' => ['type' => 'INT', 'unsigned' => true],
            'tag_id'   => ['type' => 'INT', 'unsigned' => true],
        ]);
        $this->forge->addForeignKey('quote_id', 'quotes', 'quote_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tags', 'tag_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('quotes_tags');
    }

    public function down()
    {
        $this->forge->dropTable('quotes_tags');
    }
}