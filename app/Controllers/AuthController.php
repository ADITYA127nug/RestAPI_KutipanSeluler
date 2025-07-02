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
    $data = $this->request->getJSON(true);

    if (empty($data['user_name']) || empty($data['user_email']) || empty($data['user_password'])) {
        return $this->fail('Field user_name, user_email, dan user_password wajib diisi.', 400);
    }

    $model = new UserModel();
    $existing = $model->where('user_email', $data['user_email'])->first();


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
<<<<<<< HEAD

public function registerAuthor()
{
    $data = $this->request->getJSON(); // pakai object
=======
// register Author
public function registerAuthor()
{
    $data = $this->request->getJSON(); // object
>>>>>>> a7b94ba (Update controller, model, and routes for quote & author)

    $author_name = $data->author_name ?? '';
    $author_email = $data->author_email ?? '';
    $author_password = $data->author_password ?? '';

    if (empty($author_name) || empty($author_email) || empty($author_password)) {
        return $this->fail('Field author_name, author_email, dan author_password wajib diisi.', 400);
    }

    $model = new AuthorModel();

    if ($model->where('author_email', $author_email)->first()) {
        return $this->fail('Email sudah terdaftar.', 409);
    }

    $authorData = [
        'author_name'     => $author_name,
        'author_email'    => $author_email,
        'author_password' => password_hash($author_password, PASSWORD_DEFAULT),
        'author_photo'    => null,
        'description'     => null,
    ];

    if (!$model->insert($authorData)) {
        return $this->fail($model->errors());
    }

    $newAuthor = $model->find($model->getInsertID());

    // ✅ convert to array
    $newAuthorArray = $newAuthor->toArray();
    unset($newAuthorArray['author_password']);

    return $this->respondCreated([
        'status'  => 201,
        'message' => 'Author berhasil terdaftar',
        'data'    => $newAuthorArray
    ]);
}


    // Login Author
public function loginAuthor()
{
    $data = $this->request->getJSON(true);

    $email = $data['author_email'] ?? '';
    $password = $data['author_password'] ?? '';

    if (!$email || !$password) {
        return $this->fail('Email dan password wajib diisi.', 400);
    }

    $model = new \App\Models\AuthorModel();
    $author = $model->where('author_email', $email)->first();

    if (!$author) {
        return $this->failUnauthorized('Email tidak ditemukan.');
    }

    if (!password_verify($password, $author->author_password)) {
        return $this->failUnauthorized('Password salah.');
    }

    // ✅ Konversi object ke array agar aman digunakan
    $authorArray = $author->toArray();

    // Hapus password dari response
    unset($authorArray['author_password']);

    return $this->respond([
        'status' => 200,
        'message' => 'Login author berhasil',
        'data' => $authorArray
    ]);
}




// Profile Author
public function profile($id = null)
{
    if (!$id) {
        return $this->fail('ID author diperlukan.', 400);
    }

    $model = new \App\Models\AuthorModel();
    $author = $model->find($id);

    if (!$author) {
        return $this->failNotFound('Author tidak ditemukan.');
    }

    unset($author['author_password']); // Jangan kirim password

    return $this->respond([
        'status' => 200,
        'message' => 'Berhasil ambil data profil',
        'data' => $author
    ]);
}
// Profile User
public function profileUser($id = null)
{
    if (!$id) {
        return $this->fail('ID user diperlukan.', 400);
    }

    $model = new \App\Models\UserModel();
    $user = $model->find($id);

    if (!$user) {
        return $this->failNotFound('User tidak ditemukan.');
    }

    // Konversi entity ke array
    $userArray = $user->toArray();
    unset($userArray['user_password']);

    return $this->respond([
        'status' => 200,
        'message' => 'Berhasil ambil data profil user',
        'data' => $userArray
    ]);
}


}
