<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthorModel extends Model
{
   protected $table            = 'authors';
    protected $primaryKey       = 'author_id';
    protected $returnType       = 'App\Entities\Author';
    protected $useTimestamps    = true;

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
    ];

    protected $validationMessages = [
      'author_email' => [
            'is_unique' => 'Email author sudah ada di database.',
        ],
        'author_password' => [
            'min_length' => 'Password minimal 6 karakter.'
        ],
    ];
}