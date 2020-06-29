<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;
$route['init/admin']           = 'WelcomeController/init_admin';

//////////////////////////////////////////////////////////// UMUM
$route['umum/(:any)']       = 'UmumController/index/$1';
$route['umum/store/(:any)'] = 'UmumController/store/$1';

//////////////////////////////////////////////////////////// KARYAWAN
$route['karyawan/set_session']   = 'KaryawanController/set_session';
$route['karyawan/logout/(:any)'] = 'KaryawanController/logout/$1';
$route['karyawan/(:any)']        = 'KaryawanController/index/$1';
$route['karyawan/store/(:any)']  = 'KaryawanController/store/$1';

//////////////////////////////////////////////////////////// ANGGOTA
$route['anggota/check_nia']     = 'AnggotaController/check_nia';
$route['anggota/set_session']   = 'AnggotaController/set_session';
$route['anggota/logout/(:any)'] = 'AnggotaController/logout/$1';
$route['anggota/(:any)']        = 'AnggotaController/index/$1';
$route['anggota/store/(:any)']  = 'AnggotaController/store/$1';


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
$route['admin/survey/gen_a_tiga']            = 'SurveyController/gen_a_tiga';
$route['admin/survey/gen_a_empat']           = 'SurveyController/gen_a_empat';
$route['admin/survey/store']                 = 'SurveyController/store';
$route['admin/survey/delete_question']       = 'SurveyController/delete_question';
$route['admin/survey/delete_pg']             = 'SurveyController/delete_pg';
$route['admin/survey/url/(:any)']            = 'SurveyController/url/$1';
$route['datatables/datatables_survey']       = 'SurveyController/datatables_survey';
$route['admin/survey/change_status']         = 'SurveyController/change_status';
$route['admin/survey/destroy']               = 'SurveyController/destroy';
$route['admin/survey/edit/(:any)']           = 'SurveyController/edit/$1';
$route['admin/survey/update/master']         = 'SurveyController/update_master';
$route['admin/survey/edit2/(:any)']          = 'SurveyController/edit2/$1';
$route['admin/survey/get_question']          = 'SurveyController/get_question';

# LAPORAN
// $route['admin/laporan/index/(:any)'] = 'LaporanController/index/$1';
$route['admin/laporan/excel/(:any)']          = 'LaporanController/export_survey_xls/$1';
$route['admin/laporan/pdf/(:any)']            = 'LaporanController/export_survey_pdf/$1';
$route['admin/laporan/gen_chart_satu/(:any)'] = 'LaporanController/gen_chart_satu/$1';
$route['admin/laporan/result_essay/(:any)']   = 'LaporanController/result_essay/$1';

# UTILITY
$route['admin/generate_uuid'] = 'UtilityController/generate_uuid';

########## UTILITY/ACCOUNT MANAGEMENT
$route['admin/account/index']   = 'AccountController/index';
$route['admin/account/create']  = 'AccountController/create';
$route['admin/account/destroy'] = 'AccountController/destroy';
$route['admin/account/reset']   = 'AccountController/reset';

# DATATABLES
$route['datatables/datatables_account'] = 'AccountController/datatables';