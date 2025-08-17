<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['GET', 'POST'], '/', 'UserController::index');
$routes->match(['GET', 'POST'], '/register', 'UserController::registerUser');

