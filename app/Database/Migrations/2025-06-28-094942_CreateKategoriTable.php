<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoriTable extends Migration
{
   public function up()
    {
        $this->forge->addField([
            'kategori_id'                 => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'quotes_kategori_description' => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('kategori_id', true);
        $this->forge->createTable('quotes_kategori');
    }

    public function down()
    {
        $this->forge->dropTable('quotes_kategori');
    }
}