<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['tag_id' => 1, 'tag_name' => 'kehidupan'],
            ['tag_id' => 2, 'tag_name' => 'perjuangan'],
            ['tag_id' => 3, 'tag_name' => 'harapan'],
            ['tag_id' => 4, 'tag_name' => 'realita'],
        ];
        $this->db->table('tags')->insertBatch($data);
    }
}
