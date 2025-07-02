<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('authors/login', 'Authors::login');

$routes->resource('quotes');
$routes->resource('authors');
$routes->resource('users');
$routes->resource('kategori');
$routes->resource('tags');
<<<<<<< HEAD
$routes->post('users/login', 'Users::login');
=======

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


// routes untuk profile
$routes->get('authors/(:num)', 'AuthorsController::show/$1');
$routes->get('profile-user/(:num)', 'AuthController::profileUser/$1');



//routes untuk quotes
$routes->get('quotes-all', 'Quotes::all');
//Testing quotes
$routes->get('test-simple-quotes', 'Quotes::testSimple');
>>>>>>> a7b94ba (Update controller, model, and routes for quote & author)
