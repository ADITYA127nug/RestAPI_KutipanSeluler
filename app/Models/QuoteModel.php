<?php

namespace App\Models;

use CodeIgniter\Model;

class QuoteModel extends Model
{
   protected $table            = 'quotes';
    protected $primaryKey       = 'quote_id';
    protected $returnType       = 'App\Entities\Quote';
    protected $useTimestamps    = true;
    
    protected $allowedFields    = ['author_id', 'kategori_id', 'user_id', 'quotes_title', 'quotes_comment', 'quotes_photo'];

    protected $validationRules = [
        'author_id'      => 'required|integer|is_not_unique[authors.author_id]',
        'kategori_id'    => 'required|integer|is_not_unique[kategori.kategori_id]',
        'user_id'        => 'required|integer|is_not_unique[users.user_id]',
        'quotes_title'   => 'required|min_length[5]|max_length[255]',
        'quotes_comment' => 'required|min_length[10]',
    ];

    protected $validationMessages = [
        'author_id'   => ['is_not_unique' => 'Author yang dipilih tidak valid.'],
        'kategori_id' => ['is_not_unique' => 'Kategori yang dipilih tidak valid.'],
        'user_id'     => ['is_not_unique' => 'User yang dipilih tidak valid.'],
    ];

    public function getQuoteWithDetails($id = null)
    {
        $builder = $this->select('quotes.*, authors.author_name, kategori.kategori_description')
                        ->join('authors', 'authors.author_id = quotes.author_id')
                        ->join('kategori', 'kategori.kategori_id = quotes.kategori_id');

        if ($id === null) {
            return $builder->findAll();
        }

        return $builder->where(['quotes.quote_id' => $id])->first();
    }
}
