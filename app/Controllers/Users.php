<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
      protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('User dengan ID ' . $id . ' tidak ditemukan.');
        }
        return $this->respond($data);
    }

  public function create()
{
    // Mengambil data dari x-www-form-urlencoded
    $data = $this->request->getPost();

    // Pastikan data tidak kosong
    if (empty($data)) {
        return $this->fail('Tidak ada data yang dikirim.', 400);
    }
    
    // Hash password sebelum dikirim ke model
    if (!empty($data['user_password'])) {
        $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);
    }

    if ($this->model->insert($data) === false) {
        return $this->fail($this->model->errors());
    }
    
    return $this->respondCreated([
        'status' => 201, 
        'message' => 'User berhasil dibuat',
        'data' => $this->model->find($this->model->getInsertID())
    ]);
}
    public function update($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('User dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = $this->request->getPost(true);

        // Jika ada password baru, hash terlebih dahulu
        if (!empty($data['user_password'])) {
            $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);
        }

        if ($this->model->update($id, $data) === false) {
            return $this->fail($this->model->errors());
        }

        return $this->respond([
            'status' => 200, 
            'message' => 'User berhasil diperbarui',
            'data' => $this->model->find($id)
        ]);
    }

    public function delete($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('User dengan ID ' . $id . ' tidak ditemukan.');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['status' => 200, 'message' => 'User berhasil dihapus.']);
    }
}