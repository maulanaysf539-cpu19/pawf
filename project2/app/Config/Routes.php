<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');
$routes->get('/resume','Resume::index');
$routes->get('/services','Services::index');
$routes->set404Override(function() {
    echo view('errors/not_found');
});