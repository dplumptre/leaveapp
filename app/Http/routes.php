<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::group(['middleware'=>['web']], function() {

Route::auth();

Route::get('/', function () {
    
    return view('welcome');
});





Route::get('/home', 'HomeController@index');

Route::get('access_denied', 'HomeController@access_denied');



//GENERAL
Route::get('/profile/{user}', 'HomeController@view_profile');
Route::get('/profile/{user}/edit', 'HomeController@edit_profile');
Route::patch('/profile/{user}', 'HomeController@update_profile');

Route::get('/status/{users}', 'HomeController@status');

Route::get('/apply', 'HomeController@application');
Route::post('/apply', 'HomeController@store_application');


Route::get('/leave_return/{users}/edit', 'HomeController@leave_return');
Route::patch('/leave_return/{users}', 'HomeController@leave_return_update');

Route::get('/uh_confirmation/{users}/edit', 'HomeController@uh_confirmation')->middleware('supervisor');
Route::patch('/uh_confirmation/{users}', 'HomeController@uh_confirmation_update')->middleware('supervisor');





//SUPERVISOR
Route::get('/all_leaves', 'HomeController@all_leave_status')->middleware('supervisor');
Route::get('/supervisor_approval', 'HomeController@supervisor_approval')->middleware('supervisor');
Route::get('/supervisor/{users}/edit', 'HomeController@supervisor')->middleware('supervisor');
Route::patch('/supervisor/{users}', 'HomeController@supervisor_update')->middleware('supervisor');



//ADMIN

Route::get('admins/create', 'adminsController@create');

Route::post('admins/all_Users', 'adminsController@store_user');

//View, Add and Delete Departmentss
Route::get('admins/departments', 'adminsController@view_dept');

Route::get('admins/add_dept', 'adminsController@add_dept');

Route::post('admins/new_dept', 'adminsController@store_dept');


//View, Add and Delete Grade Level
Route::get('admins/grades', 'adminsController@view_grades');

Route::get('admins/add_grade', 'adminsController@add_grade');

Route::post('admins/new_grade', 'adminsController@store_grade');

Route::get('admins/{grade}/delete_grade', 'adminsController@delete_grade');


//View, Add and Delete Employee Type
Route::get('admins/employee_type', 'adminsController@view_employee_type');

Route::get('admins/add_employee_type', 'adminsController@add_employee_type');

Route::post('admins/new_employee_type', 'adminsController@store_employee_type');

Route::get('admins/{type}/delete_employee_type', 'adminsController@delete_employee_type');

//RESET COLUMN

Route::get('admins/reset', 'adminsController@reset');

Route::post('admins/reset_leave', 'adminsController@reset_column');



Route::post('admins/all_users', 'adminsController@store_user');

Route::get('admins/users', 'adminsController@all_users');

Route::get('admins/{user}/edit', 'adminsController@edit_user');

Route::patch('admins/{user}', 'adminsController@update_user');

Route::get('admins/{user}/delete', 'adminsController@delete_user');

Route::get('admins/{dept}/delete_dept', 'adminsController@delete_dept');


Route::get('admins/users/{id}', 'adminsController@show');

Route::get('admins/search', 'adminsController@search_page');

Route::get('admins/search_result/{search}', 'adminsController@show_search');

Route::post('admins/search_result', 'adminsController@search');

//ADMIN Approval
Route::get('admins/{users}/admin_edit', 'adminsController@admin_edit');

Route::patch('admins/{users}/admin_edit', 'adminsController@admin_approval');

//ADMIN Confirmation
Route::get('admins/{users}/admin_confirm', 'adminsController@admin_confirm');

Route::patch('admins/{users}/admin_confirm', 'adminsController@admin_confirmation');



//LEAVE
Route::get('admins/requests', 'adminsController@show_all_leave_request');

Route::get('admins/return', 'adminsController@show_all_leave_return');

Route::get('admins/application_status', 'adminsController@application_status');

Route::get('admins/{user}/history', 'adminsController@leave_history');

Route::get('admins/application_search', 'adminsController@search_page');

Route::get('admins/application_search/{search}', 'adminsController@show_search');

Route::post('admins/application_search', 'adminsController@search');







//------------------------------------------------------------------------------
//LOAN APPLICATION
//------------------------------------------------------------------------------
Route::get('/loan_application', 'HomeController@loan_application');
Route::post('/store_loan', 'HomeController@store_loan');

Route::get('/loan_status/{users}', 'HomeController@loan_status');

Route::get('/user_loan_status/{users}', 'HomeController@user_loan_status');

Route::get('/loan_info/{users}', 'HomeController@loan_info');

Route::get('/loan_edit/{users}', 'HomeController@loan_edit');
Route::patch('/update_loan_edit/{users}', 'HomeController@update_loan_edit');

Route::patch('/complete_status/{users}', 'HomeController@complete_status');
Route::patch('/repayment_status/{users}', 'HomeController@repayment_status');


Route::get('/admins/loan_applications', 'adminsController@show_all_loan_applications');
Route::get('/admins/{loan_id}/admin_loan_edit', 'adminsController@admin_loan_edit');

Route::patch('/admins/{users}/admin_loan_approve', 'adminsController@admin_loan_approve');

Route::patch('/admins/{users}/mgt_loan_approve', 'PayrollController@mgt_loan_approve');

Route::patch('/admins/{users}/gm_loan_approve', 'GmController@gm_loan_approve');


// });