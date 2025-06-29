<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Taruh route custom **sebelum** resource agar tidak override
$routes->post('authors/login', 'Authors::login');

// RESTful resources
$routes->resource('quotes');
$routes->resource('authors');
$routes->resource('users');
$routes->resource('kategori');
$routes->resource('tags');

// $routes->post('authors/login', 'Authors::login');
// $routes->resource('authors');

// app/Config/Routes.php

// $routes->resource('users');
$routes->post('users/login', 'Users::login'); // <-- Tambahkan ini