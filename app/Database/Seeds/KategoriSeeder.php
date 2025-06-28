<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kategori_id' => 1, 'kategori_description' => 'Inspirasi'],
            ['kategori_id' => 2, 'kategori_description' => 'Motivasi Hidup'],
            ['kategori_id' => 3, 'kategori_description' => 'Filsafat'],
        ];
        $this->db->table('kategori')->insertBatch($data);
    }
}
