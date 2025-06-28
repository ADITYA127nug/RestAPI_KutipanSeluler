<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
      public function run()
    {
        $data = [
            [
                'user_id'       => 1,
                'user_name'     => 'testing',
                'user_email'    => 'testing@gmail.com',
                'user_password' => password_hash('password123', PASSWORD_DEFAULT)
            ],
            [
                'user_id'       => 2,
                'user_name'     => 'testing 2',
                'user_email'    => 'testing2@gmail.com',
                'user_password' => password_hash('password123', PASSWORD_DEFAULT)
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
