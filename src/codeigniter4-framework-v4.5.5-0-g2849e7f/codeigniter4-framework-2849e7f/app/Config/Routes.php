<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BookController::index');
$routes->post('books/search', 'BookController::search');
$routes->post('books/filter', 'BookController::filter');
$routes->post('books/sort', 'BookController::sort');
$routes->post('books/updateStatus', 'BookController::updateStatus');
$routes->get('books/history/(:segment)', 'BookController::history/$1');
$routes->get('books/history', 'BookController::history'); // Tambahkan ini


