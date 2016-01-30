<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return redirect()->to('home');
// });
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::get('/', function () {
    return view('layouts.app');
});

Route::group(['prefix' => 'api'], function()
{
    Route::post('authenticate', 'RegistrationController@authenticate');
	Route::post('register', 'RegistrationController@store');
});

Route::group(['middleware' => ['web', 'jwt.auth']], function() {
    Route::get('authenticate/user', 'UsersController@getAuthUser');
	Route::get('users', 'UsersController@index');
	Route::get('user/{id}', 'UsersController@show');
	Route::put('user/update', 'UsersController@update');
	Route::delete('user/delete/{id}', 'UsersController@destroy');
});


// Route::get('{catchall}', function () {
//     return view('layouts.app');
// })->where('catchall', '(.*)');