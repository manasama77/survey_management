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
$route['admin/survey/index']                 = 'SurveyController/index';
$route['admin/survey/create/(:any)']         = 'SurveyController/create/$1';
$route['admin/survey/create_question']       = 'SurveyController/create_question';
$route['admin/survey/generate_id_question']  = 'SurveyController/generate_id_question';
$route['admin/survey/store_q']               = 'SurveyController/store_q';
$route['admin/survey/gen_a_satu']            = 'SurveyController/gen_a_satu';
$route['admin/survey/update_a_satu']         = 'SurveyController/update_a_satu';
$route['admin/survey/generate_id_answer_pg'] = 'SurveyController/generate_id_answer_pg';
$route['admin/survey/store']                 = 'SurveyController/store';

# UTILITY
$route['admin/generate_uuid'] = 'UtilityController/generate_uuid';
