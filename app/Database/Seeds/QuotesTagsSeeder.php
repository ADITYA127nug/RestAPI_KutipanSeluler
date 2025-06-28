<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuotesTagsSeeder extends Seeder
{
     public function run()
    {
        $data = [
            // Quote 1 (Tere Liye) diberi tag 'harapan' dan 'kehidupan'
            ['quote_id' => 1, 'tag_id' => 3],
            ['quote_id' => 1, 'tag_id' => 1],
            
            // Quote 2 (Pramoedya) diberi tag 'perjuangan' dan 'realita'
            ['quote_id' => 2, 'tag_id' => 2],
            ['quote_id' => 2, 'tag_id' => 4],

            // Quote 3 (Rowling) diberi tag 'harapan'
            ['quote_id' => 3, 'tag_id' => 3],
        ];
        $this->db->table('quotes_tags')->insertBatch($data);
    }
}