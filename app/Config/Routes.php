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


