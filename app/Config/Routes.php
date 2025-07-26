<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Guest\GuestController::index');
$routes->get('/about', 'Guest\GuestController::about');


$routes->get('logout', 'Auth\LoginController::logout');


$routes->get('/register', 'Auth\RegisterController::index');
$routes->post('/register/process', 'Auth\RegisterController::process');

$routes->get('login', 'Auth\LoginController::index');
$routes->post('login/process', 'Auth\LoginController::process');

$routes->get('user/dashboard', 'User\DashboardUser::index');
$routes->get('admin/dashboard', 'User\DashboardAdmin::index');
$routes->get('user/dashboard/detail/(:num)', 'User\DashboardUser::detail/$1');

$routes->get('materi', 'Material\MaterialController::index');
$routes->get('materi/upload', 'Material\MaterialController::upload');
$routes->post('materi/save', 'Material\MaterialController::save');
$routes->get('materi/detail/(:num)', 'Material\MaterialController::detail/$1');
$routes->post('materi/delete/(:num)', 'Material\MaterialController::delete/$1');
$routes->get('materi/edit/(:num)', 'Material\MaterialController::edit/$1');
$routes->post('materi/update/(:num)', 'Material\MaterialController::update/$1');
$routes->get('materi/approval', 'Material\ApprovalController::index');
$routes->get('materi/approval/approve/(:num)', 'Material\ApprovalController::approve/$1');
$routes->get('materi/approval/reject/(:num)', 'Material\ApprovalController::reject/$1');
$routes->get('materi/approval/close/(:num)', 'Material\ApprovalController::close/$1');

$routes->post('user/comment/store/(:num)', 'Comment\CommentController::store/$1');
$routes->post('user/comment/submit', 'User\DashboardUser::submitKomentar');
$routes->get('user', 'User\UserController::index');
$routes->get('user/create', 'User\UserController::create');
$routes->post('user/store', 'User\UserController::store');
$routes->get('user', 'User\UserController::index');
$routes->post('user/delete/(:num)', 'User\UserController::delete/$1');
$routes->get('user/edit/(:num)', 'User\UserController::edit/$1');
$routes->post('user/update/(:num)', 'User\UserController::update/$1');
$routes->get('user/detail/(:num)', 'User\UserController::show/$1');
