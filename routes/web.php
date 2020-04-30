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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');










//===========================================================================

Route::get('/admin', 'LAMA\IndexController@index')->middleware('auth');

//TODO all routs should be post after debugging
Route::get('/admin/sys/getMyOrgans', 'LAMA\AdminDetailsController@getMyOrgans')->middleware(['isLogin']);
Route::get('/admin/sys/getMyCurrentOrgan', 'LAMA\AdminDetailsController@getMyCurrentOrgan')->middleware(['isLogin']);
Route::get('/admin/sys/getMyRoles', 'LAMA\AdminDetailsController@getMyRoles')->middleware(['isLogin']);
Route::get('/admin/sys/getMyRolesOfCurrentOrgan', 'LAMA\AdminDetailsController@getMyRolesOfCurrentOrgan')->middleware(['isLogin']);
Route::get('/admin/sys/getMyCurrentRole', 'LAMA\AdminDetailsController@getMyCurrentRole')->middleware(['isLogin']);
Route::get('/admin/sys/getMyModules', 'LAMA\AdminDetailsController@getMyModules')->middleware(['isLogin', 'isSetOrgan']);

Route::get('/admin/sys/getUserDetails', 'LAMA\AdminDetailsController@getUserDetails')->middleware(['isLogin']);



Route::get('/admin/sys/changeOrgan', 'LAMA\SysController@changeOrgan')->middleware(['isLogin']);
Route::get('/admin/sys/changeRole', 'LAMA\SysController@changeRole')->middleware(['isLogin', 'isSetOrgan']);

Route::get('/admin/sys/module/{moduleSysName}/{method}', 'LAMA\ModuleController@index')->middleware(['isLogin', 'isSetOrgan', 'isSetRole']);
Route::post('/admin/sys/module/{moduleSysName}/{method}', 'LAMA\ModuleController@index')->middleware(['isLogin', 'isSetOrgan', 'isSetRole']);


Route::get('/admin/logout', 'LAMA\SysController@logout');
Route::get('/admin/test', function () {
    return dump(session()->all());
});
