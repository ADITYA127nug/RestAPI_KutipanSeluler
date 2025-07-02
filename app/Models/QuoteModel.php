<?php

namespace App\Models;

use CodeIgniter\Model;

class QuoteModel extends Model
{
   protected $table            = 'quotes';
    protected $primaryKey       = 'quote_id';
    protected $returnType       = 'array';
    protected $useTimestamps    = true;
    
    protected $allowedFields = [
        'quotes_title',
        'quotes_comment',
        'kategori_id',
        'author_id',
        'user_id',
        'quotes_photo',
        'created_at',
        'updated_at',
    ];

    

    protected $validationRules = [
        'quotes_title'   => 'required',
        'quotes_comment' => 'required',
        'kategori_id'    => 'required|is_natural_no_zero',
        'author_id'      => 'required|is_natural_no_zero',
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
