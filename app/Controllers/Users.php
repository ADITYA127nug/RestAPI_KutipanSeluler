<?php

namespace App\Controllers;

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

        unset($data->user_password); // Jangan tampilkan hash password
        return $this->respond($data);
    }

    // Berfungsi sebagai 'register'
    public function create()
    {
        // PERBAIKAN: Ubah kembali ke getJSON(true) untuk menerima data dari Flutter
    $data = $this->request->getJSON(true);

    if (empty($data)) {
        return $this->fail('Tidak ada data yang dikirim.', 400);
    }

    // Logika hashing password tetap sama
    if (isset($data['user_password'])) {
        $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);
    }

    if ($this->model->insert($data) === false) {
        return $this->fail($this->model->errors());
    }
    
    $newUser = $this->model->find($this->model->getInsertID());
    unset($newUser->user_password);

    return $this->respondCreated([
        'status'  => 201,
        'message' => 'User berhasil dibuat',
        'data'    => $newUser
    ]);
    }

    public function update($id = null)
    {
        if ($this->model->find($id) === null) {
            return $this->failNotFound('User dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = $this->request->getJSON(true);

        if (!empty($data['user_password'])) {
            $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);
        } else {
            unset($data['user_password']);
        }

        if ($this->model->update($id, $data) === false) {
            return $this->fail($this->model->errors());
        }
        
        $updatedUser = $this->model->find($id);
        unset($updatedUser->user_password);

        return $this->respond([
            'status'  => 200,
            'message' => 'User berhasil diperbarui',
            'data'    => $updatedUser
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

    // Fungsi untuk Login User
    public function login()
    {
        $data = $this->request->getJSON();

        if (!isset($data->user_email) || !isset($data->user_password)) {
            return $this->fail('Email dan password harus diisi.', 400);
        }

        $user = $this->model->where('user_email', $data->user_email)->first();

        if ($user && password_verify($data->user_password, $user->user_password)) {
            unset($user->user_password);

            return $this->respond([
                'status'  => 200,
                'message' => 'Login berhasil',
                'data'    => $user
            ]);
        }

        return $this->failUnauthorized('Email atau Password salah');
    }
}