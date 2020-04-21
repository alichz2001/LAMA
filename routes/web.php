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


Route::get('/admin/sys/getMyCompanies', 'Admin\SysController@getMyCompanies')->middleware(['isLogin']);
Route::get('/admin/sys/getMyCurrentCompany', 'Admin\SysController@getMyCurrentCompany')->middleware(['isLogin']);
Route::get('/admin/sys/getMyRoles', 'Admin\SysController@getMyRoles')->middleware(['isLogin']);
Route::get('/admin/sys/getMyCurrentRole', 'Admin\SysController@getMyCurrentRole')->middleware(['isLogin']);
Route::get('/admin/sys/getMyModules', 'Admin\SysController@getMyModules')->middleware(['isLogin', 'isSetCompany']);
