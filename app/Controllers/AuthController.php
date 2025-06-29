<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AuthorModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $format = 'json';

    // Register User
    public function registerUser()
    {
        $data = $this->request->getPost();

        if (empty($data['user_name']) || empty($data['user_email']) || empty($data['user_password'])) {
            return $this->fail('Field user_name, user_email, dan user_password wajib diisi.', 400);
        }

        $model = new UserModel();
        $existing = $model->where('user_email', $data['user_email'])->first();
        if ($existing) {
            return $this->fail('Email sudah terdaftar.', 409);
        }

        $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);

        if (!$model->insert($data)) {
            return $this->fail($model->errors());
        }

        $newUser = $model->find($model->getInsertID());
        return $this->respondCreated([
            'status' => 201,
            'message' => 'User berhasil terdaftar',
            'data' => $newUser
        ]);
    }

    // Login User
   public function loginUser()
{
    $json = $this->request->getJSON();
    $email = $json->user_email ?? '';
    $password = $json->user_password ?? '';

    if (!$email || !$password) {
        return $this->fail('Email dan password wajib diisi.', 400);
    }

    $model = new \App\Models\UserModel();
    $user = $model->where('user_email', $email)->first();

    // ✅ Perbaikan akses entitas
    if (!$user || !password_verify($password, $user->user_password)) {
        return $this->failUnauthorized('Email atau password salah.');
    }

    return $this->respond([
        'status' => 200,
        'message' => 'Login user berhasil',
        'data' => $user
    ]);
}



    // Register Author
    public function registerAuthor()
    {
        $data = $this->request->getPost();

        if (empty($data['author_name']) || empty($data['author_email']) || empty($data['author_password'])) {
            return $this->fail('Field author_name, author_email, dan author_password wajib diisi.', 400);
        }

        $model = new AuthorModel();
        $existing = $model->where('author_email', $data['author_email'])->first();
        if ($existing) {
            return $this->fail('Email sudah terdaftar.', 409);
        }

        $data['author_password'] = password_hash($data['author_password'], PASSWORD_DEFAULT);

        if (!$model->insert($data)) {
            return $this->fail($model->errors());
        }

        $newAuthor = $model->find($model->getInsertID());
        return $this->respondCreated([
            'status' => 201,
            'message' => 'Author berhasil terdaftar',
            'data' => $newAuthor
        ]);
    }

    // Login Author
    public function loginAuthor()
    {
        $email = $this->request->getPost('author_email');
        $password = $this->request->getPost('author_password');

        if (!$email || !$password) {
            return $this->fail('Email dan password wajib diisi.', 400);
        }

        $model = new AuthorModel();
        $author = $model->where('author_email', $email)->first();

        if (!$author || !password_verify($password, $author['author_password'])) {
            return $this->failUnauthorized('Email atau password salah.');
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Login author berhasil',
            'data' => $author
        ]);
    }
}
