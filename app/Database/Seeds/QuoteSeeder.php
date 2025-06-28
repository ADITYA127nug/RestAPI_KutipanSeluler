<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuoteSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'quote_id'       => 1,
                'author_id'      => 2, // Tere Liye
                'kategori_id'    => 1, // Inspirasi
                'user_id'        => 1, // testing
                'quotes_title'   => 'Tentang Harapan',
                'quotes_comment' => 'Jangan pernah menyerah, bahkan ketika semuanya terasa mustahil.',
            ],
            [
                'quote_id'       => 2,
                'author_id'      => 3, // Pramoedya
                'kategori_id'    => 3, // Filsafat
                'user_id'        => 2, // testing 2
                'quotes_title'   => 'Kemanusiaan',
                'quotes_comment' => 'Kalian boleh maju dalam pelajaran, tapi tanpa mencintai sastra, kalian tinggal hanya hewan yang pandai.',
            ],
            [
                'quote_id'       => 3,
                'author_id'      => 1, // J.K. Rowling
                'kategori_id'    => 2, // Motivasi Hidup
                'user_id'        => 1, // testing
                'quotes_title'   => 'Pilihan Hidup',
                'quotes_comment' => 'Bukan kemampuan kita yang menunjukkan siapa kita sebenarnya, melainkan pilihan kita.',
            ],
        ];
        $this->db->table('quotes')->insertBatch($data);
    }
}
