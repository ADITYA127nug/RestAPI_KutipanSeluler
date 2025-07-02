<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Authors extends ResourceController
{
    protected $modelName = 'App\Models\AuthorModel';
    protected $format    = 'json';

    public function login()
    {
        // 1. Dapatkan input JSON dari Flutter
        $json = $this->request->getJSON();
        $email = $json->email ?? null;
        $password = $json->password ?? null;

        // 2. Validasi input dasar
        if (!$email || !$password) {
            return $this->fail('Email dan password wajib diisi.', 400);
        }

        // 3. Cari author berdasarkan email menggunakan model
        //    Model akan mengembalikan sebuah objek Entity karena $returnType di model Anda
        $authorEntity = $this->model->where('author_email', $email)->first();

        if (!$authorEntity) {
            return $this->failNotFound('Email tidak ditemukan.');
        }

        // 4. Verifikasi password dengan aman menggunakan password_verify()
        //    Ini membandingkan password dari Flutter dengan hash di database.
        //    Asumsi: Model Anda mengembalikan Entity, jadi kita akses propertinya.
        if (!password_verify($password, $authorEntity->author_password)) {
            return $this->failUnauthorized('Password salah.');
        }

        // 5. Jika login berhasil, siapkan data untuk dikirim kembali
        //    Gunakan toArray() untuk mengubah Entity menjadi array
        $authorData = $authorEntity->toArray();
        
        // Hapus password dari data yang akan dikirim kembali untuk keamanan
        unset($authorData['author_password']);

        // 6. Kirim respons yang sesuai dengan yang diharapkan oleh Flutter
        return $this->respond([
            'status'  => 'success', // Flutter mengharapkan 'success', bukan 200
            'message' => 'Login berhasil, selamat datang ' . $authorData['author_name'] . '!',
            'data'    => $authorData
        ]);
    }

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $author = $this->model->find($id);
        $model = new \App\Models\AuthorModel();

        if (!$author) {
            return $this->failNotFound("Author dengan ID $id tidak ditemukan.");
        }

        return $this->respond([
            'status' => 200,
            'data' => $author
        ]);
    }

    public function create()
    {
        $json = $this->request->getJSON(true); // Ambil sebagai array

        // Hash password sebelum disimpan ke database
        if (isset($json['author_password'])) {
            $json['author_password'] = password_hash($json['author_password'], PASSWORD_DEFAULT);
        }

        if (!$this->model->insert($json)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'status' => 201,
            'message' => 'Author berhasil ditambahkan'
        ]);
    }

    public function update($id = null)
    {
        $json = $this->request->getJSON(true); // Ambil sebagai array

        // Jika ada password baru, hash password tersebut
        if (isset($json['author_password']) && !empty($json['author_password'])) {
            $json['author_password'] = password_hash($json['author_password'], PASSWORD_DEFAULT);
        } else {
            // Jangan update password jika kosong
            unset($json['author_password']);
        }

        if (!$this->model->update($id, $json)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Author berhasil diupdate'
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound("Author dengan ID $id tidak ditemukan.");
        }
        
        if (!$this->model->delete($id)) {
            return $this->fail('Gagal menghapus author.', 500);
        }

        return $this->respondDeleted([
            'status' => 200,
            'message' => 'Author berhasil dihapus'
        ]);
    }
}
