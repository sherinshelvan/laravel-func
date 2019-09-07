<?php

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
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
})->where('locale', '[A-Za-z]+')->name('locale');


Route::get('/home', 'HomeController@index')->name('home');
/*Route::prefix('/admin')->group(function () {
	Route::get('/', 'Admin\LoginController@index');
});*/
Route::get('/test', 'TestController@index')->name('test');
Route::post('/test', 'TestController@upload')->name('test.upload');




Route::group(['prefix'  => '/admin', 'namespace' => 'Admin'], function() {
	Route::get('/', 'LoginController@index')->name('admin.login');
	Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
	Route::get('/login', 'LoginController@index')->name('admin.login');

	Route::match(['get', 'post'], '/user', 'UserController@index')->name('admin.user');
	Route::get('/user/create', 'UserController@create')->name('admin.user.create');
	Route::post('/user/create', 'UserController@store')->name('admin.user.store');
	Route::get('/user/edit/{id}', 'UserController@edit')->name('admin.user.edit')->where('id', '[0-9]+');
	Route::post('/user/edit/{id}', 'UserController@update')->name('admin.user.update')->where('id', '[0-9]+');
	Route::get('/user/destroy/{id}', 'UserController@destroy')->name('admin.user.destroy')->where('id', '[0-9]+');

	Route::get('/profile', 'ProfileController@index')->name('admin.profile');

});
/*Route::namespace('Admin')->group(function () {
Route::prefix('/admin')->group(function () {
	Route::get('/', 'LoginController@index');
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/login', 'LoginController@index');
	Route::get('/user', 'UserController@index');
	Route::get('/user/create', 'UserController@create');
});
});*/