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
        return $this->respond($this->model->getQuoteWithDetails());
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
        $data = $this->request->getJSON(true); // Mengambil data sebagai array

        // Model akan otomatis menjalankan validasi saat insert
        if ($this->model->insert($data) === false) {
            return $this->fail($this->model->errors());
        }
        
        $response = [
            'status'   => 201,
            'messages' => ['success' => 'Quote berhasil dibuat.'],
            'data'     => $this->model->getQuoteWithDetails($this->model->getInsertID())
        ];
        return $this->respondCreated($response);
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
}