<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{ protected $table            = 'tags';
    protected $primaryKey       = 'tag_id';
    protected $returnType       = 'App\Entities\Tag';
    protected $useTimestamps    = false;

    protected $allowedFields    = ['tag_name'];

    protected $validationRules = [
        'tag_name' => 'required|max_length[100]|is_unique[tags.tag_name,tag_id,{id}]',
    ];

    protected $validationMessages = [
        'tag_name' => [
            'is_unique' => 'Nama tag tersebut sudah ada.',
        ],
    ];
}