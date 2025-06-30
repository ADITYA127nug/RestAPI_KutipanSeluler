<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthorModel extends Model
{
    protected $table            = 'authors';
    protected $primaryKey       = 'author_id';
    protected $returnType       = 'App\Entities\Author'; 
    
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'author_name',
        'author_email',
        'author_password',
        'author_photo',
        'description',
    ];

    protected $validationRules = [
        'author_name'      => 'required|min_length[3]|max_length[150]',
        'author_email'     => 'required|valid_email|is_unique[authors.author_email,author_id,{id}]',
        'author_password'  => 'required|min_length[8]',
    ];


    protected $validationMessages = [
        'author_email' => [
            'is_unique' => 'Email author sudah ada di database.',
        ],
        'author_password' => [
            'required'   => 'Password tidak boleh kosong.',
            'min_length' => 'Password minimal 8 karakter.',
        ],
    ];
}
