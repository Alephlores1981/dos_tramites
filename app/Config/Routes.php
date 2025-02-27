<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('tramites', [
    'placeholder' => '(:num)',
  //  'except'      => ['show'] // si no usamos'show'
]);

$routes->post('tramites/(:num)/instancia', 'Tramites::agregarInstancia/$1');
