<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Authors extends ResourceController
{
    protected $modelName = 'App\Models\AuthorModel';
    protected $format    = 'json';
    
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

     public function show($id = null)
    {
        $author = $this->model->find($id);

        if (!$author) {
            return $this->failNotFound('Author tidak ditemukan.');
        }

        return $this->respond([
            'status' => 200,
            'data' => $author
        ]);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->model->insert($data) === false) {
            return $this->fail($this->model->errors());
        }
        
        return $this->respondCreated([
            'status' => 201, 
            'message' => 'Author berhasil dibuat',
            'data' => $this->model->find($this->model->getInsertID())
        ]);
    }

    public function update($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('Author dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = $this->request->getJSON(true);

        if ($this->model->update($id, $data) === false) {
            return $this->fail($this->model->errors());
        }

        return $this->respond([
            'status' => 200, 
            'message' => 'Author berhasil diperbarui',
            'data' => $this->model->find($id)
        ]);
    }

    public function delete($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('Author dengan ID ' . $id . ' tidak ditemukan.');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['status' => 200, 'message' => 'Author berhasil dihapus.']);
    }
}