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
//COCHES
$routes->get('/Unidades', "CUnidades::index");
$routes->get('/Unidades/(:any)', 'CUnidades::unidad/$1');
/*ADMIN*/
//USUARIOS
$routes->get('/admin/Usuarios', "CUsuarios::index");
$routes->get('/admin/Usuarios/Add', "CUsuarios::new");
$routes->post('/admin/Usuarios/Add', "CUsuarios::new");
