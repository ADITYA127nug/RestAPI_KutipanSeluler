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
$routes->post('users/login', 'Users::login');