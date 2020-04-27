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

Route::get('/admin', 'Admin\DashboardController@index')->middleware('auth');

//TODO all routs should be post after debugging
Route::get('/admin/sys/getMyOrgans', 'Admin\AdminDetailsController@getMyOrgans')->middleware(['isLogin']);
Route::get('/admin/sys/getMyCurrentOrgan', 'Admin\AdminDetailsController@getMyCurrentOrgan')->middleware(['isLogin']);
Route::get('/admin/sys/getMyRoles', 'Admin\AdminDetailsController@getMyRoles')->middleware(['isLogin']);
Route::get('/admin/sys/getMyRolesOfCurrentOrgan', 'Admin\AdminDetailsController@getMyRolesOfCurrentOrgan')->middleware(['isLogin']);
Route::get('/admin/sys/getMyCurrentRole', 'Admin\AdminDetailsController@getMyCurrentRole')->middleware(['isLogin']);
Route::get('/admin/sys/getMyModules', 'Admin\AdminDetailsController@getMyModules')->middleware(['isLogin', 'isSetOrgan']);



Route::get('/admin/sys/changeOrgan', 'Admin\SysController@changeOrgan')->middleware(['isLogin']);
Route::get('/admin/sys/changeRole', 'Admin\SysController@changeRole')->middleware(['isLogin', 'isSetOrgan']);

Route::get('/admin/sys/getModule', 'Admin\ModuleController@view')->middleware(['isLogin', 'isSetOrgan', 'isSetRole']);

Route::get('/admin/test', function () {
    return dump(session()->all());
});
