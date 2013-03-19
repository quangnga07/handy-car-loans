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


$route['default_controller'] = "frontend/page/index/";
$route['404_override'] = 'frontend/page/index/error_404';

/* Scores */
$route['scores']        = 'frontend/scores';
$route['scores/(:any)'] = 'frontend/scores/$1';

/* Admin Batch Controll */
$route['admin/batch']               = 'backend/batch';
$route['admin/batch/(:any)']        = 'backend/batch/$1';
$route['admin/batch/(:any)/(:any)'] = 'backend/batch/$1/$2';

/* Admin Notifications */
$route['admin/notification'] 			   = 'backend/notification';
$route['admin/notification/(:any)']        = 'backend/notification/$1';
$route['admin/notification/(:any)/(:any)'] = 'backend/notification/$1/$2';

/* Admin Configure */
$route['admin/configure'] 				= 'backend/configure';
$route['admin/configure/(:any)'] 		= 'backend/configure/$1';
$route['admin/configure/(:any)/(:any)'] = 'backend/configure/$1/$2';

/* Admin Client */
$route['admin/client'] 			     = 'backend/client';
$route['admin/client/(:any)']		 = 'backend/client/$1';
$route['admin/client/(:any)/(:any)'] = 'backend/client/$1/$2';

/* Admin Print */
$route['admin/print'] 			     = 'backend/print_record';
$route['admin/print/(:any)']		 = 'backend/print_record/$1';

/* Admin Search Module */
$route['admin/search']        = 'backend/search';
$route['admin/search/(:any)'] = 'backend/search/$1';

/* Admin Email */
$route['admin/email/(:any)'] = 'backend/email/$1';
$route['admin/email']        = 'backend/email';

/* Admin Scores */
$route['admin/scores']        = 'backend/scores';
$route['admin/scores/(:any)'] = 'backend/scores/$1';

/* Admin Manage User */
$route['admin/users']        = 'backend/users';
$route['admin/users/(:any)'] = 'backend/users/$1';

/* Admin Manage CMS */
$route['admin/cms']        = 'backend/cms';
$route['admin/cms/(:any)'] = 'backend/cms/$1';

/* Custom Routes */
$route['admin']        = 'backend/admin';
$route['admin/(:num)'] = 'backend/admin/index/$1';
$route['admin/(:any)'] = 'backend/admin/$1';




/* Pages */
//$route['page']        = 'frontend/page/index';
$route['index']       = 'frontend/page/index';
//$route['page/(:any)'] = 'frontend/page/index/$1';

/* Registration */
//$route['registration']        = 'frontend/registration';
$route['registration/(:any)'] = 'frontend/registration/$1';

$route['apply']        = 'frontend/registration';
$route['apply/(:any)'] = 'frontend/registration/index/$1';

$route['reapply/(:any)'] = 'frontend/reapply/index/$1';

/* Document Uploader */
$route['document']                 = 'frontend/uploader';
$route['doc_upload/(:any)']        = 'frontend/uploader/$1';
$route['doc_upload/(:any)/(:any)'] = 'frontend/uploader/$1/$2';
$route['documentuploader/(:any)']  = 'frontend/uploader/application_documents/$1';
$route['documentuploader/(:any)/(:any)']  = 'frontend/uploader/application_documents/$1/$2';

/* Contact Us */
$route['contact-us'] = 'frontend/page/contact';
$route['send-message'] = 'frontend/page/send_message';
$route['validate-captcha'] = 'frontend/page/validate_captcha';

$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';

/* To remove the page/ on the url. Always at the bottom of the routes hierarchy */
$route['(:any)'] = 'frontend/page/index/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */