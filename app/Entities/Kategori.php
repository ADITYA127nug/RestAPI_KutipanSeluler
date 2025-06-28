<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Kategori extends Entity
{
     protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'kategori_id' => 'integer'
    ];
}