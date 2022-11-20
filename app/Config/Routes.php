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
$routes->setAutoRoute(true);
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

/**
 * Route Authentication
 */

$routes->group('admin', ['filter' => 'noauth'], function($routes) {
    // Route Login
    $routes->add('login', 'Admin\Admin::login');
    // Route Forgot Password
    $routes->add('forgot-password', 'Admin\Admin::forgotpassword');
    // Route Resset Password
    $routes->add('resset-password', 'Admin\Admin::ressetpassword');
});
    // Route Logout
    $routes->add('admin/logout', 'Admin\Admin::logout');

/**
 * Route Admin
 */

$routes->group('admin', ['filter' => 'auth'], function($routes) {

    // Auth Confirm
    $routes->add('auth-sukses', 'Admin\Admin::sukses');

    // Routes Dashboard
    $routes->add('dashboard', 'Admin\Dashboard::index');
    $routes->add('dashboard', 'Admin\Dashboard::edit');

    // Routes Home
    $routes->add('home/index', 'Admin\Home::index');
    $routes->add('home/create', 'Admin\Home::create');
    $routes->add('home/edit/(:any)', 'Admin\Home::edit/$1');

    // Routes Services
    $routes->add('services/index', 'Admin\Services::index');
    $routes->add('services/create', 'Admin\Services::create');
    $routes->add('services/edit/(:any)', 'Admin\Services::edit/$1');

    // Routes Abouts
    $routes->add('abouts/index', 'Admin\Abouts::index');
    $routes->add('abouts/create', 'Admin\Abouts::create');
    $routes->add('abouts/edit/(:any)', 'Admin\Abouts::edit/$1');

    // Routes Works
    $routes->add('works/index', 'Admin\Works::index');
    $routes->add('works/create', 'Admin\Works::create');
    $routes->add('works/edit/(:any)', 'Admin\Works::edit/$1');

    // Routes Testimonials
    $routes->add('testimonials/index', 'Admin\Testimonials::index');
    $routes->add('testimonials/create', 'Admin\Testimonials::create');
    $routes->add('testimonials/edit/(:any)', 'Admin\Testimonials::edit/$1');

    // Routes Feedback
    $routes->add('feedbacks/index', 'Admin\Feedbacks::index');
    $routes->add('feedbacks/create', 'Admin\Feedbacks::create');
    $routes->add('feedbacks/edit/(:any)', 'Admin\Feedbacks::edit/$1');

    // Routes Contacts
    $routes->add('contacts/index', 'Admin\Contacts::index');
    $routes->add('contacts/edit/(:any)', 'Admin\Contacts::edit/$1');

});

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
