<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('mahasiswa', ['controller' => 'MahasiswaController']);

$routes->match(['post', 'options'], 'api/mahasiswa', 'MahasiswaController::create'); 
$routes->match(['post', 'options'], 'api/mahasiswa/:any', 'MahasiswaController::updateMahasiswa/$1'); 