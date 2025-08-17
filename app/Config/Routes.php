<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['GET', 'POST'], '/', 'UserController::index', [ 'filter'    =>  'noauth' ]);
$routes->match(['GET', 'POST'], 'register', 'UserController::registerUser', [ 'filter' =>  'noauth' ]);
$routes->match(['GET', 'POST'], 'dashboard', 'Dashboard::index', [ 'filter' =>  'auth' ]);
$routes->get('logout', 'UserController::logout');


