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
$routes->get('/', 'Home::index');

// make db
$routes->get('create-db', function()
{
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('db_laboratorium')) {
        echo 'Database created!';
    }
});

// login
$routes->get('login', 'Auth::login');
$routes->post('auth/prosesLogin', 'Auth::prosesLogin');
// register
$routes->get('registrasi', 'Auth::register');
$routes->post('auth/prosesRegister', 'Auth::prosesRegister');
$routes->get('logout', 'Auth::logout');


// peminjam
$routes->get('peminjam', 'Peminjam::index');
$routes->get('peminjam/form_pinjam', 'Peminjam::formPinjam');
$routes->post('peminjam/save', 'Peminjam::save');
$routes->get('peminjam/riwayat/(:any)', 'Peminjam::riwayat/$1');
$routes->get('peminjam/detail/(:num)', 'Peminjam::detail/$1');
$routes->get('peminjam/edit/(:num)', 'Peminjam::edit/$1');
$routes->put('peminjam/update/(:num)', 'Peminjam::update/$1');
$routes->get('peminjam/batalkan_permohonan/(:num)', 'Peminjam::batalkanPermohonan/$1');
$routes->get('peminjam/contoh', 'Peminjam::contohSurat');
$routes->get('peminjam/download_bukti/(:num)', 'Peminjam::downloadBukti/$1');
$routes->get('peminjam/download_surat_balasan/(:num)', 'Peminjam::downloadSuratBalasan/$1');
$routes->get('peminjam/hapusSemua/(:any)/(:num)', 'Peminjam::hapusSemua/$1/$2');


// Laboran
$routes->get('laboran', 'Laboran::index');
$routes->get('laboran/riwayat/(:any)', 'Laboran::riwayat/$1');
$routes->get('laboran/detail/(:num)', 'Laboran::detail/$1');
$routes->get('laboran/penjadwalan/(:num)', 'Laboran::penjadwalan/$1');
$routes->post('laboran/jadwalkan', 'Laboran::jadwalkan');
$routes->get('laboran/tolak_permohonan/(:num)', 'Laboran::tolakPermohonan/$1');
$routes->get('laboran/download_bukti/(:num)', 'Peminjam::downloadBukti/$1');
$routes->get('laboran/acc/(:num)/(:num)', 'Laboran::serahkanKalab/$1/$2');
$routes->get('laboran/jadwal', 'Laboran::jadwal');
$routes->get('laboran/download_surat_balasan/(:num)', 'Laboran::downloadSuratBalasan/$1');
$routes->get('laboran/hapusSemua/(:any)', 'Laboran::hapusSemua/$1');
$routes->get('laboran/hapusJadwal/(:num)/(:num)', 'Laboran::hapusJadwal/$1/$2');


// ruangan
$routes->presenter('ruangan');

// kalab
$routes->get('kalab', 'Kalab::index');
$routes->get('kalab/laporan', 'Kalab::laporan');
$routes->get('kalab/detail/(:num)', 'Kalab::detail/$1');
$routes->get('kalab/download_bukti/(:num)', 'Peminjam::downloadBukti/$1');
$routes->get('kalab/tolak/(:num)', 'Kalab::tolakPermohonan/$1');
$routes->post('kalab/acc/(:num)/(:any)', 'Kalab::accPermohonan/$1/$2');
$routes->get('kalab/jadwal', 'Kalab::jadwal');




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
