<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Authors extends ResourceController
{
    protected $modelName = 'App\Models\AuthorModel';
    protected $format    = 'json';
<<<<<<< HEAD

    public function login()
    {
        $json = $this->request->getJSON();
        $email = $json->email ?? null;
        $password = $json->password ?? null;

        if (!$email || !$password) {
            return $this->failValidationErrors('Email dan password wajib diisi');
        }

        $author = $this->model->where('author_email', $email)->first();

        if (!$author) {
            return $this->failNotFound('Email tidak ditemukan');
        }

        $authorData = $author->toRawArray();

        if ($authorData['author_password'] !== $password) {
            return $this->failUnauthorized('Password salah');
        }

        unset($authorData['author_password']); // hapus password dari response

        return $this->respond([
            'status' => 200,
            'message' => 'Login berhasil, selamat datang ' . $authorData['author_name'] . '!',
            'data' => $authorData
        ]);
    }

=======
    
>>>>>>> b5d9b63d889fcea0773916f26398181fca7aab2b
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

     public function show($id = null)
    {
<<<<<<< HEAD
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound("Author dengan ID $id tidak ditemukan.");
=======
        $author = $this->model->find($id);

        if (!$author) {
            return $this->failNotFound('Author tidak ditemukan.');
>>>>>>> b5d9b63d889fcea0773916f26398181fca7aab2b
        }

        return $this->respond([
            'status' => 200,
            'data' => $author
        ]);
    }

    public function create()
    {
        $json = $this->request->getJSON();
    if (!$this->model->insert($json)) {
        return $this->failValidationErrors($this->model->errors());
    }

    return $this->respondCreated([
        'status' => 201,
        'message' => 'Author berhasil ditambahkan',
        'data' => $json
    ]);
    }

    public function update($id = null)
    {
        $json = $this->request->getJSON();
        if (!$this->model->update($id, $json)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Author berhasil diupdate',
            'data' => $json
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->model->delete($id)) {
            return $this->failNotFound("Author dengan ID $id tidak ditemukan atau gagal dihapus.");
        }

        return $this->respondDeleted([
            'status' => 200,
            'message' => 'Author berhasil dihapus'
        ]);
    }
}
