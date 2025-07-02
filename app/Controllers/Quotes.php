<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Quotes extends ResourceController
{
    protected $modelName = 'App\Models\QuoteModel';
    protected $format    = 'json';

    public function index()
    {
        $kategoriId = $this->request->getGet('kategori_id');

        $quotes = $this->model
            ->select('quotes.*, kategori.kategori_description, authors.author_name')
            ->join('kategori', 'kategori.kategori_id = quotes.kategori_id')
            ->join('authors', 'authors.author_id = quotes.author_id');

        if ($kategoriId) {
            $quotes->where('quotes.kategori_id', $kategoriId);
        }

        return $this->respond($quotes->orderBy('quotes.created_at', 'DESC')->findAll());
    }


    public function show($id = null)
    {
        $data = $this->model->getQuoteWithDetails($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Quote dengan ID ' . $id . ' tidak ditemukan.');
    }

  public function create()
    {
        $rules = [
            'quotes_title'   => 'required',
            'quotes_comment' => 'required',
            'kategori_id'    => 'required|is_natural_no_zero',
            'author_id'      => 'required|is_natural_no_zero',
            'quotes_photo'   => 'uploaded[quotes_photo]|is_image[quotes_photo]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $file = $this->request->getFile('quotes_photo');
        $newName = $file->getRandomName();
        $file->move('uploads', $newName);

        $data = [
            'quotes_title'   => $this->request->getVar('quotes_title'),
            'quotes_comment' => $this->request->getVar('quotes_comment'),
            'kategori_id'    => $this->request->getVar('kategori_id'),
            'author_id'      => $this->request->getVar('author_id'),
            'quotes_photo'   => $newName,
        ];

        if (!$this->model->insert($data)) {
            return $this->fail($this->model->errors());
        }

        return $this->respondCreated([
            'status'   => 201,
            'messages' => ['success' => 'Quote berhasil dipublish'],
            'data'     => $data,
        ]);
    }


    public function update($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('Quote dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = $this->request->getJSON(true);

        // Model akan otomatis menjalankan validasi saat update
        if ($this->model->update($id, $data) === false) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status'   => 200,
            'messages' => ['success' => 'Quote berhasil diperbarui.'],
            'data'     => $this->model->getQuoteWithDetails($id)
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('Quote dengan ID ' . $id . ' tidak ditemukan.');
        }

        $this->model->delete($id);
        return $this->respondDeleted(['status' => 200, 'message' => 'Quote berhasil dihapus.']);
    }

    public function getQuoteWithDetails($id = null, $kategoriId = null)
{
    $builder = $this->select('quotes.*, kategori.kategori_description, authors.author_name')
                    ->join('kategori', 'kategori.kategori_id = quotes.kategori_id')
                    ->join('authors', 'authors.author_id = quotes.author_id');

    if ($id) {
        return $builder->where('quote_id', $id)->first();
    }

    if ($kategoriId) {
        $builder->where('quotes.kategori_id', $kategoriId);
    }

    return $builder->orderBy('quotes.created_at', 'DESC')->findAll();
}
public function all()
{
    try {
        log_message('debug', 'Memulai fungsi all() di Quotes controller');

        $quotes = $this->model
            ->select('quotes.quote_id, quotes.quotes_title, quotes.quotes_comment, quotes.quotes_photo, quotes.created_at, authors.author_name, kategori.kategori_description')
            ->join('authors', 'authors.author_id = quotes.author_id', 'left')
            ->join('kategori', 'kategori.kategori_id = quotes.kategori_id', 'left')
            ->orderBy('quotes.created_at', 'DESC')
            ->findAll();

        log_message('debug', 'Berhasil mengambil data quotes');

        return $this->respond($quotes);
    } catch (\Throwable $e) {
        log_message('error', 'Error di Quotes::all(): ' . $e->getMessage());
        return $this->failServerError($e->getMessage());
    }
}



public function testSimple()
{
    try {
        // Hanya ambil data dari quotes tanpa join
        $model = new \App\Models\QuoteModel();
        $quotes = $model->findAll();
        return $this->respond($quotes);
    } catch (\Throwable $e) {
        return $this->failServerError($e->getMessage());
    }
}

}
