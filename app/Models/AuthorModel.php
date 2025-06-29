<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthorModel extends Model
{
    protected $table            = 'authors';
    protected $primaryKey       = 'author_id';
    protected $returnType       = 'App\Entities\Author';
    protected $useTimestamps    = true;

<<<<<<< HEAD
    protected $allowedFields    = [
        'author_name', 
        'author_email', 
        'author_photo', 
        'description',
        'author_password',
        'quotes_title',
        'kategori'];

    protected $validationRules = [
         'author_name'  => 'required|min_length[3]|max_length[150]',
        'author_email' => 'required|valid_email|is_unique[authors.author_email,author_id,{id}]',
        'author_password' => 'permit_empty|min_length[6]',
        'quotes_title'    => 'permit_empty|max_length[255]',
        'kategori'        => 'permit_empty|max_length[255]',
=======
    protected $allowedFields = [
        'author_name',
        'author_email',
        'author_password',
        'author_photo',
        'description',
    ];

    protected $validationRules = [
        'author_name'      => 'required|min_length[3]|max_length[150]',
        'author_email'     => 'required|valid_email|is_unique[authors.author_email]',
        'author_password'  => 'required|min_length[8]',
>>>>>>> b5d9b63d889fcea0773916f26398181fca7aab2b
    ];

    protected $validationMessages = [
      'author_email' => [
            'is_unique' => 'Email author sudah ada di database.',
        ],
        'author_password' => [
<<<<<<< HEAD
            'min_length' => 'Password minimal 6 karakter.'
=======
            'required'   => 'Password tidak boleh kosong.',
            'min_length' => 'Password minimal 8 karakter.',
>>>>>>> b5d9b63d889fcea0773916f26398181fca7aab2b
        ],
    ];
}