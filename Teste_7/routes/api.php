<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth'], function () {
	Route::post('login', 'App\Http\Controllers\Auth\LoginController@index');
	// Route::post('signup', 'App\Http\Controllers\Auth\SignupController@index');

	Route::group(['middleware' => 'auth:api'], function() {
		Route::get('logout', 'App\Http\Controllers\Auth\LogoutController@index');
		// Route::get('user', 'App\Http\Controllers\Auth\UserController@index');
	});
});

/*
|--------------------------------------------------------------------------
| API Resource Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => 'auth:api'], function() {

	Route::get('users', 'App\Http\Controllers\Api\Users\ReadController@index');

	Route::post('users', 'App\Http\Controllers\Api\Users\CreateController@index');

	Route::put('users', 'App\Http\Controllers\Api\Users\UpdateController@index');

	Route::delete('users', 'App\Http\Controllers\Api\Users\DeleteController@index');

});
