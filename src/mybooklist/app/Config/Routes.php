<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/book_catalog', 'Book::catalog');
$routes->get('/book/(:num)', 'Book::view/$1');

// Tambahkan route untuk menambah ke wishlist dan memulai reading
$routes->get('/book/addWishlist/(:num)', 'Book::addWishlist/$1');
$routes->get('/book/startReading/(:num)', 'Book::startReading/$1');
$routes->get('/book/completeBook/(:num)', 'Book::completeBook/$1');

// Route for book management
$routes->get('/book_management', 'Book::management');

// Autentikasi
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/register', 'Auth::register');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

// Profile
$routes->get('/profile', 'Profile::index', ['filter' => 'auth']);
$routes->post('/profile/updateUsername', 'Profile::updateUsername', ['filter' => 'auth']);
$routes->post('/profile/updatePassword', 'Profile::updatePassword', ['filter' => 'auth']);
$routes->post('/profile/updateLocation', 'Profile::updateLocation', ['filter' => 'auth']);
