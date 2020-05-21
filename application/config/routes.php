<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;
$route['init/admin']           = 'WelcomeController/init_admin';

//////////////////////////////////////////////////////////// LOGIN ADMIN
$route['default_controller'] = 'LoginAdminController/index';
$route['logout/admin']       = 'LoginAdminController/logout';

//////////////////////////////////////////////////////////// ADMIN
# DASHBOARD
$route['admin/dashboard'] = 'DashboardController/index';

# SURVEY
$route['admin/survey']                 = 'SurveyController/index';
$route['admin/survey/create']          = 'SurveyController/create';
$route['admin/survey/create_question'] = 'SurveyController/create_question';
$route['admin/survey/store']           = 'SurveyController/index';
