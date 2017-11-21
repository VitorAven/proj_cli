<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = "principal";
$route['404_override'] = 'principal';

// Usuários
$route['usuario'] = 'usuario';
$route['login'] = 'usuario/login';
$route['logout'] = 'usuario/logout';
$route['alterar-senha'] = 'usuario/alterarsenha';
$route['usuario/adicionar'] = 'usuario/adicionar';
$route['usuario/(:num)/editar'] = 'usuario/editar/$1';
$route['usuario/(:num)/editar'] = 'usuario/editar/$1';
$route['usuario/(:num)/excluir'] = 'usuario/excluir/$1';


/* Médicos*/
$route['medico/list'] = 'medicos';
$route['medico/add'] = 'medicos/adicionar';
$route['medico/(:num)'] = 'medicos/editar/$1';
$route['medico/excluir/(:num)'] = 'medicos/excluir/$1';

/* Pacientes*/
$route['paciente/list'] = 'pacientes';
$route['paciente/add'] = 'pacientes/adicionar';
$route['paciente/(:num)'] = 'pacientes/editar/$1';
$route['paciente/excluir/(:num)'] = 'pacientes/excluir/$1';

/* Consulta*/
$route['consulta/list'] = 'consultas';
$route['consulta/list_free'] = 'consultas/disponiveis';
$route['consulta/add'] = 'consultas/adicionar';
$route['consulta/(:num)'] = 'consultas/editar/$1';
$route['consulta/excluir/(:num)'] = 'consultas/excluir/$1';
