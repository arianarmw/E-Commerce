<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// BARANG
$routes->get('/barang', 'C_Barang::display');

//KERANJANG
$routes->get('/keranjang', 'C_Keranjang::display');
$routes->get('/keranjang/add/(:segment)/(:segment)', 'C_Keranjang::add/$1/$2'); // (:segment) = parameter, $1 = parameter pertama yang di ambil
$routes->post('/keranjang/update', 'C_Keranjang::update');
$routes->get('/keranjang/remove/(:segment)', 'C_Keranjang::remove/$1'); // (:segment) = parameter, $1 = parameter pertama yang di ambil

//TRANSAKSI
$routes->get('/checkout', 'C_Transaksi::display'); // untuk menampilkan data
$routes->post('/checkout/save', 'C_Transaksi::save'); // untuk menampilkan data

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
