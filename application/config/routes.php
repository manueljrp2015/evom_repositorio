<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
/* 
 * frontend web 
 */
 
$route['default_controller'] = "frontend/redirect";
$route['home'] = "frontend/home";
$route['add-miembro/(:any)'] = "frontend/registrocontroller";
$route['ini-panel'] = "frontend/initcontroller";
$route['red-view'] = "frontend/redescontroller";
$route['analisis-red-view'] = "frontend/redescontroller/analisis";
$route['profile'] = "frontend/profilecontroller";
$route['config-pwd'] = "frontend/configcontroller/indexConfigPwd";
$route['404_override'] = '';
$route['403_override'] = 'error/errorcontroller/errorcontroller';
$route['quienes_somos'] = 'frontend/pagecontroller';
$route['mision_vision'] = 'frontend/pagecontroller/page2';
$route['valores'] = 'frontend/pagecontroller/page3';
$route['preguntas-frecuentes'] = 'frontend/pagecontroller/page4';
$route['get-kit'] = 'frontend/kitcontroller';
$route['kit-todos'] = 'frontend/kitcontroller/get_kits_all';
$route['kit-pago'] = 'frontend/kitcontroller/kit_pago';
$route['exec-pago-kits'] = 'frontend/kitcontroller/pago_exec';
$route['mis-kits'] = 'frontend/kitcontroller/mis_kits';
$route['noticias'] = 'frontend/noticescontroller';
/* 
 * admin web 
 */
$route['admin'] = 'admin/home';
$route['admin/config-header'] = 'admin/configcontroller/configHeader';
$route['admin/config-footer'] = 'admin/configcontroller/configFooter';
$route['admin/config-create-users'] = 'admin/configcontroller/configNewUser';
$route['admin/reportes'] = 'admin/reportescontroller';
$route['admin/notices'] = 'admin/noticecontroller';
$route['admin/kits'] = 'admin/kitscontroller';



//$route['portafolio/(:any)'] = "portafolio/ver_portafolio/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */