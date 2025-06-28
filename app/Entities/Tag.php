<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Tag extends Entity
{
     protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'tag_id' => 'integer'
    ];
}
