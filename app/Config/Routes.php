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
/*VENDEDOR*/
//VENTAS
$routes->get('/admin/Ventas', "CVentas::tramitar");
$routes->get('/admin/Ventas/Aceptar/(:any)', "CVentas::aceptar/$1");
$routes->get('/admin/Ventas/Cancelar/(:any)', "CVentas::cancelar/$1");
/*ADMIN*/
//USUARIOS
$routes->get('/admin/Usuarios', "CUsuarios::index");
$routes->get('/admin/Usuarios/Tipo/(:any)', "CUsuarios::filtrado/$1");
$routes->get('/admin/Usuarios/Add', "CUsuarios::new");
$routes->post('/admin/Usuarios/Add', "CUsuarios::new");
$routes->get('/admin/Usuarios/Borrar/(:any)', "CUsuarios::delete/$1");
$routes->get('/admin/Usuarios/Actualizar/(:any)', "CUsuarios::update/$1");
$routes->post('/admin/Usuarios/Actualizar/(:any)', "CUsuarios::update/$1");
//UNIDADES
$routes->get('/admin/Unidades', "CUnidades::admin");
$routes->post('/admin/Unidades', "CUnidades::rebaja");
$routes->get('/admin/Unidades/Add', "CUnidades::add");
$routes->post('/admin/Unidades/Add', "CUnidades::add");
$routes->get('/admin/Unidades/Actualizar/(:any)', "CUnidades::update/$1");
$routes->post('/admin/Unidades/Actualizar/(:any)', "CUnidades::update/$1");
$routes->get('/admin/Unidades/Borrar/(:any)', "CUnidades::delete/$1");
//VENTAS
$routes->get('/admin/VerVentas', "CVentas::admin");
$routes->get('/admin/Ventas/Canceladas/Borrar', "CVentas::delete");