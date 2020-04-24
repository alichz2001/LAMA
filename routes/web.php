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

Route::get('/admin', 'Admin\DashboardController@dashboard');


Route::get('/admin/sys/getMyCompanies', 'Admin\AdminDetailsController@getMyCompanies')->middleware(['isLogin']);
Route::get('/admin/sys/getMyCurrentCompany', 'Admin\AdminDetailsController@getMyCurrentCompany')->middleware(['isLogin']);
Route::get('/admin/sys/getMyRoles', 'Admin\AdminDetailsController@getMyRoles')->middleware(['isLogin']);
Route::get('/admin/sys/getMyRolesOfCurrentCompany', 'Admin\AdminDetailsController@getMyRolesOfCurrentCompany')->middleware(['isLogin']);
Route::get('/admin/sys/getMyCurrentRole', 'Admin\AdminDetailsController@getMyCurrentRole')->middleware(['isLogin']);
Route::get('/admin/sys/getMyModules', 'Admin\AdminDetailsController@getMyModules')->middleware(['isLogin', 'isSetCompany']);



Route::get('/admin/sys/changeCompany', 'Admin\SysController@changeCompany')->middleware(['isLogin']);
Route::get('/admin/sys/changeRole', 'Admin\SysController@changeRole')->middleware(['isLogin', 'isSetCompany']);

Route::get('/admin/sys/getModule', 'Admin\SysController@getModule')->middleware(['isLogin', 'isSetCompany', 'isSetRole']);

Route::get('/admin/test', function () {
    return dump(session()->all());
});
