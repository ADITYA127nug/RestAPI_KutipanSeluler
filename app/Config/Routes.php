<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Membuat semua rute RESTful untuk QuotesController
$routes->resource('quotes');

// Membuat semua rute RESTful untuk AuthorsController
$routes->resource('authors');

// Membuat semua rute RESTful untuk UsersController
$routes->resource('users');

// Membuat semua rute RESTful untuk KategoriController
$routes->resource('kategori');

// Membuat semua rute RESTful untuk TagsController
$routes->resource('tags');

// ==================================================

$routes->post('auth/register-user', 'AuthController::registerUser');
$routes->post('auth/login-user', 'AuthController::loginUser');
$routes->post('auth/register-author', 'AuthController::registerAuthor');
$routes->post('auth/login-author', 'AuthController::loginAuthor');

$routes->resource('quotes');
$routes->get('authors/(:num)', 'AuthorsController::show/$1');
$routes->get('authors/(:num)', 'AuthorController::show/$1');
$routes->get('users/(:num)', 'UserController::show/$1');

// Menangani semua request OPTIONS untuk CORS preflight
$routes->options('(:any)', function () {
    return response()
        ->setStatusCode(200)
        ->setHeader('Access-Control-Allow-Origin', '*')
        ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
        ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
        ->setBody('OK');
});
