<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/comments/', 'Comments::index');
$routes->post('/comments/', 'Comments::index');
$routes->get('/comments/get-comments/', 'Comments::getComments');
$routes->get('/comments/edit/(:num)', 'Comments::edit/$1');
$routes->post('/comments/edit/(:num)', 'Comments::edit/$1');
