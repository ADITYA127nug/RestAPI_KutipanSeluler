<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
   protected $table            = 'kategori';
    protected $primaryKey       = 'kategori_id';
    protected $returnType       = 'App\Entities\Kategori';
    protected $useTimestamps    = false;

    protected $allowedFields    = ['kategori_description'];

    protected $validationRules = [
        'kategori_description' => 'required|max_length[255]|is_unique[kategori.kategori_description,kategori_id,{id}]',
    ];

    protected $validationMessages = [
        'kategori_description' => [
            'is_unique' => 'Nama kategori tersebut sudah ada.',
        ],
    ];
}