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
$routes->setDefaultController('Pages');
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
$routes->get('/', 'Pages::index');
$routes->match(['get','post'],'features/shop/filter','Features::filterItems',['filter' => 'auth']);
$routes->match(['get','post'],'features/rateItem','Features::updateRating',['filter' => 'auth']);
$routes->match(['get','post'],'features/isInFavourites','Features::isInFavourites',['filter' => 'auth']);
$routes->match(['get','post'],'features/shop/search','Features::searchItem',['filter' => 'auth']);
$routes->match(['get', 'post'], 'features/removeFavourite', 'Features::removeFavourite',['filter' => 'auth']);
$routes->match(['get', 'post'], 'features/addFavourite', 'Features::addFavourite',['filter' => 'auth']);
$routes->get('/item/(:any)','Features::item/$1',['filter' => 'auth']);
$routes->match(['get', 'post'], 'features/deleteItem', 'Features::deleteItem',['filter' => 'auth']);
$routes->match(['get', 'post'], 'features/addItem', 'Features::addItem',['filter' => 'auth']);
$routes->get('/profile', 'Features::profile',['filter' => 'auth']);
$routes->match(['get', 'post'], 'userAuth/register', 'AuthController::register');
$routes->match(['get', 'post'], 'userAuth/login', 'AuthController::login');
$routes->match(['get', 'post'], 'userAuth/logout', 'AuthController::logout');
$routes->get('/shop','Features::index');
$routes->get('/login', 'AuthController::loginPage');
$routes->get('/register', 'AuthController::registerPage');
$routes->get('(:any)', 'Pages::view/$1');

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
