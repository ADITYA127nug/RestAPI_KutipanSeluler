<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Kategori extends ResourceController
{
    protected $modelName = 'App\Models\KategoriModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }
        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->model->insert($data) === false) {
            return $this->fail($this->model->errors());
        }
        
        return $this->respondCreated([
            'status' => 201,
            'message' => 'Kategori berhasil dibuat',
            'data' => $this->model->find($this->model->getInsertID())
        ]);
    }

    public function update($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }
        $data = $this->request->getJSON(true);

        if ($this->model->update($id, $data) === false) {
            return $this->fail($this->model->errors());
        }
        return $this->respond([
            'status' => 200, 
            'message' => 'Kategori berhasil diperbarui',
            'data' => $this->model->find($id)
        ]);
    }

    public function delete($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['status' => 200, 'message' => 'Kategori berhasil dihapus.']);
    }
}