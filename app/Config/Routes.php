<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//LOGIN
$routes->get('/Login', "CLogin::index");
$routes->get('/Logout', "CLogin::logout");
$routes->post('/Login', 'CLogin::index');
//REGISTRO
$routes->get('/Signup', 'CRegistroUsuario::index');
$routes->post('/Signup', 'CRegistroUsuario::index');
//COCHES
$routes->get('/Unidades', "CUnidades::index");
$routes->get('/Unidades/(:any)', 'CUnidades::unidad/$1');
$routes->get('/Comprar/(:any)', 'CVentas::comprar/$1');
/*ADMIN*/
//USUARIOS
$routes->get('/admin/Usuarios', "CUsuarios::index");
$routes->get('/admin/Usuarios/Tipo/(:any)', "CUsuarios::filtrado/$1");
$routes->get('/admin/Usuarios/Add', "CUsuarios::new");
$routes->post('/admin/Usuarios/Add', "CUsuarios::new");
$routes->get('/admin/Usuarios/Borrar/(:any)', "CUsuarios::delete/$1");
$routes->get('/admin/Usuarios/Actualizar/(:any)', "CUsuarios::update/$1");
$routes->post('/admin/Usuarios/Actualizar/(:any)', "CUsuarios::update/$1");
