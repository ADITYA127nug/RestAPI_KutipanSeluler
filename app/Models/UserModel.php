<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $returnType       = 'App\Entities\User';
    protected $useTimestamps    = true;
    
    protected $allowedFields    = ['user_name', 'user_email', 'user_password'];

    // Aturan Validasi
    protected $validationRules = [
        'user_name'     => 'required|min_length[3]|max_length[100]',
        'user_email'    => 'required|valid_email|is_unique[users.user_email,user_id,{id}]',
        'user_password' => 'required|min_length[8]',
    ];

    // Pesan Error Kustom untuk Validasi
    protected $validationMessages = [
        'user_email' => [
            'is_unique'   => 'Maaf, email tersebut sudah terdaftar. Silakan gunakan email lain.',
            'valid_email' => 'Format email tidak valid.',
        ],
        'user_password' => [
            'min_length' => 'Password minimal harus terdiri dari 8 karakter.',
        ],
    ];
}