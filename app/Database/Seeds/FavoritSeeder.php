<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FavoritSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // User Budi (1) memfavoritkan quote Pramoedya (2)
            ['user_id' => 1, 'quote_id' => 2],
            
            // User Ani (2) memfavoritkan quote Tere Liye (1)
            ['user_id' => 2, 'quote_id' => 1],

            // User Ani (2) juga memfavoritkan quote Rowling (3)
            ['user_id' => 2, 'quote_id' => 3],
        ];
        $this->db->table('favorit')->insertBatch($data);
    }
}