<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['author_id' => 1, 'author_name' => 'J.K. Rowling', 'author_email' => 'jk@gmail.com'],
            ['author_id' => 2, 'author_name' => 'Tere Liye', 'author_email' => 'tere@gmail.com'],
            ['author_id' => 3, 'author_name' => 'Pramoedya Ananta Toer', 'author_email' => 'pram@gmail.com'],
        ];
        $this->db->table('authors')->insertBatch($data);
    }
}