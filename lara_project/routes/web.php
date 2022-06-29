<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});
////////////////*****employee  Module*****///////////////
Route::get('/index', 'EmpController@getIndex');
Route::get('/create', 'EmpController@createUser')->name('userCreate');
//get district
Route::post('/district', 'EmpController@getDistrict')->name('district');
//get Thana
Route::post('/thana', 'EmpController@getThana')->name('thana');
Route::get('/userlist', 'EmpController@userList')->name('userList');
Route::get('/edit/{id}', 'EmpController@editUser')->name('userEdit');
Route::patch('/update/{id}', 'EmpController@updateUser')->name('userUpdate');
Route::post('/store', 'EmpController@storeData')->name('store');
Route::get('/delete/{id}', 'EmpController@destroyUser')->name('userDestroy');
//status change
Route::post('/status', 'EmpController@changeStatus')->name('statusChange');


//////////****employee attendance Module****//////////////
Route::get('/attend/index', 'AttendController@getIndex')->name('attend.index');
Route::post('/attend/store', 'AttendController@storeData')->name('attend.store');
Route::get('/attend/userList', 'AttendController@getUserList')->name('attend.userList');
Route::post('/attend/searchList', 'AttendController@searchUserList')->name('attend.searchList');
/////Modal for employee address
Route::post('/attend/modal', 'AttendController@showModal')->name('attend.modalShow');
//attend details(submit[+])part
Route::get('/details', 'AttendController@showDetails')->name('attend.detailsShow');
Route::post('/findDate', 'AttendController@findDate')->name('attend.date');
Route::post('/findTime', 'AttendController@findTime')->name('attend.time');
Route::post('/addRow', 'AttendController@addRow')->name('attend.addRow');

////////REPORT/////////////////////
Route::get('/report', 'AttendController@showReport')->name('reportShow');
Route::post('/reportSearch', 'AttendController@searchReportData')->name('reportSearch');

























