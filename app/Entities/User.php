<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];

    // Method untuk menyembunyikan password saat di-cast ke array/json
    protected function getPassword()
    {
        return null;
    }
}