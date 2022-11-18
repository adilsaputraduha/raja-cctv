<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index', ['filter' => 'auth']);
// Login
$routes->get('/login', 'LoginController::index');
$routes->get('/register', 'LoginController::register');
$routes->post('/login/ceklogin', 'LoginController::ceklogin');
$routes->post('/register/save', 'LoginController::saveregister');
$routes->get('/logout', 'LoginController::logout', ['filter' => 'auth']);
// User
$routes->get('/user', 'UserController::index', ['filter' => 'auth']);
$routes->post('/user/save', 'UserController::save', ['filter' => 'auth']);
$routes->post('/user/edit', 'UserController::edit', ['filter' => 'auth']);
$routes->post('/user/delete', 'UserController::delete', ['filter' => 'auth']);
$routes->get('/user/report', 'UserController::report', ['filter' => 'auth']);
// Pelanggan
$routes->get('/pelanggan', 'PelangganController::index', ['filter' => 'auth']);
$routes->post('/pelanggan/save', 'PelangganController::save', ['filter' => 'auth']);
$routes->post('/pelanggan/edit', 'PelangganController::edit', ['filter' => 'auth']);
$routes->post('/pelanggan/delete', 'PelangganController::delete', ['filter' => 'auth']);
$routes->get('/pelanggan/report', 'PelangganController::report', ['filter' => 'auth']);
$routes->post('/pelanggan/reset', 'PelangganController::reset', ['filter' => 'auth']);
// Jenis
$routes->get('/jenis', 'JenisController::index', ['filter' => 'auth']);
$routes->post('/jenis/save', 'JenisController::save', ['filter' => 'auth']);
$routes->post('/jenis/edit', 'JenisController::edit', ['filter' => 'auth']);
$routes->post('/jenis/delete', 'JenisController::delete', ['filter' => 'auth']);
$routes->get('/jenis/report', 'JenisController::report', ['filter' => 'auth']);
// Produk
$routes->get('/produk', 'ProdukController::index', ['filter' => 'auth']);
$routes->post('/produk/save', 'ProdukController::save', ['filter' => 'auth']);
$routes->post('/produk/edit', 'ProdukController::edit', ['filter' => 'auth']);
$routes->post('/produk/delete', 'ProdukController::delete', ['filter' => 'auth']);
$routes->get('/produk/report', 'ProdukController::report', ['filter' => 'auth']);
// Pemesanan
$routes->get('/pemesanan', 'PemesananController::index', ['filter' => 'auth']);
$routes->get('/pemesanan/tambah', 'PemesananController::add', ['filter' => 'auth']);
$routes->get('/pemesanan/update/(:segment)', 'PemesananController::update/$1', ['filter' => 'auth']);
$routes->post('/pemesanan/detail-index', 'PemesananController::detailindex', ['filter' => 'auth']);
$routes->post('/pemesanan/detail-save', 'PemesananController::detailsave', ['filter' => 'auth']);
$routes->post('/pemesanan/detail-delete', 'PemesananController::detaildelete', ['filter' => 'auth']);
$routes->post('/pemesanan/save', 'PemesananController::save', ['filter' => 'auth']);
$routes->post('/pemesanan/edit', 'PemesananController::edit', ['filter' => 'auth']);
$routes->post('/pemesanan/status', 'PemesananController::status', ['filter' => 'auth']);
$routes->get('/pemesanan/faktur/(:segment)', 'PemesananController::faktur/$1', ['filter' => 'auth']);
$routes->post('/pemesanan/batal', 'PemesananController::batal', ['filter' => 'auth']);
// Pemesanan Pelanggan
$routes->get('/pemesanan/tambah/(:segment)/(:segment)', 'PemesananController::tambah/$1/$2', ['filter' => 'auth']);
$routes->post('/pemesanan/pesansekarang', 'HomeController::pesansekarang', ['filter' => 'auth']);
// Pembayaran
$routes->get('/pembayaran', 'PembayaranController::index', ['filter' => 'auth']);
$routes->get('/pembayaran/tambah', 'PembayaranController::add', ['filter' => 'auth']);
$routes->get('/pembayaran/update/(:segment)', 'PembayaranController::update/$1', ['filter' => 'auth']);
$routes->post('/pembayaran/detail-index', 'PembayaranController::detailindex', ['filter' => 'auth']);
$routes->post('/pembayaran/save', 'PembayaranController::save', ['filter' => 'auth']);
$routes->post('/pembayaran/edit', 'PembayaranController::edit', ['filter' => 'auth']);
$routes->post('/pembayaran/batal', 'PembayaranController::batal', ['filter' => 'auth']);
$routes->get('/pembayaran/faktur/(:segment)', 'PembayaranController::faktur/$1', ['filter' => 'auth']);
// Report
$routes->get('/report', 'ReportController::index', ['filter' => 'auth']);
$routes->get('/report/pemesanan/(:segment)/(:segment)', 'ReportController::reportpemesanan/$1/$2', ['filter' => 'auth']);
$routes->get('/report/pemesanan/bulan/(:segment)/(:segment)', 'ReportController::reportpemesananbulan/$1/$2', ['filter' => 'auth']);
$routes->get('/report/pesan/tahun/(:segment)', 'ReportController::reportpemesanantahun/$1', ['filter' => 'auth']);

$routes->get('/report/pembayaran/(:segment)/(:segment)', 'ReportController::reportpembayaran/$1/$2', ['filter' => 'auth']);
$routes->get('/report/pembayaran/bulan/(:segment)/(:segment)', 'ReportController::reportpembayaranbulan/$1/$2', ['filter' => 'auth']);
$routes->get('/report/bayar/tahun/(:segment)', 'ReportController::reportpembayarantahun/$1', ['filter' => 'auth']);

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
