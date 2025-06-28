<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Quote extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'quote_id'    => 'integer',
        'author_id'   => 'integer',
        'kategori_id' => 'integer',
        'user_id'     => 'integer',
    ];
}