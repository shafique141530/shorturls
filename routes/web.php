<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShorturlController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




	
 
 
 
Route::group(array('middleware' => 'App\Http\Middleware\GuestAdmin'), function () {
	Route::any('/', array('as' => 'login-admin', 'uses' => 'App\Http\Controllers\LoginController@login'));
	Route::any('/login', array('as' => 'login', 'uses' => 'App\Http\Controllers\LoginController@login'));
});


Route::get('/logout', array('as' => 'logout', 'uses' => 'App\Http\Controllers\LoginController@logout'))->middleware('App\Http\Middleware\AuthAdmin');

Route::get('/shorturls', 			ShorturlController::class .'@index')->name('shorturl.index')->middleware('App\Http\Middleware\AuthAdmin');
Route::get('/shorturl/create', 		ShorturlController::class . '@create')->name('shorturl.create')->middleware('App\Http\Middleware\AuthSubAdminAndMemeber');
Route::post('/shorturl/store', 		ShorturlController::class .'@store')->name('shorturl.store')->middleware('App\Http\Middleware\AuthSubAdminAndMemeber');
Route::get('/shorturl/edit/{id}', 	ShorturlController::class .'@edit')->name('shorturl.edit')->middleware('App\Http\Middleware\AuthSubAdminAndMemeber');
Route::put('/shorturl/update/{id}', ShorturlController::class .'@update')->name('shorturl.update')->middleware('App\Http\Middleware\AuthSubAdminAndMemeber');


Route::get('/users', 			UserController::class .'@index')->name('users.index')->middleware('App\Http\Middleware\AuthAdminAndMemeber');
Route::get('/users/create', 	UserController::class . '@create')->name('users.create')->middleware('App\Http\Middleware\AuthAdminAndMemeber');
Route::post('/users/store', 	UserController::class .'@store')->name('users.store')->middleware('App\Http\Middleware\AuthAdminAndMemeber');


Route::get('/s/{id}', 	ShorturlController::class .'@hit')->name('shorturl.hit');