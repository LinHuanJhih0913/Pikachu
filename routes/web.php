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
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'LoginController@create');
Route::post('/login', 'LoginController@store');

Route::middleware('auth')->group(function () {
    Route::get('/u/{user}', 'UserController@show');
    Route::put('/u/{user}', 'UserController@update');
    Route::get('/logout', 'LoginController@destory');

    Route::get('/payment', 'PaymentController@create');
    Route::post('/payment', 'PaymentController@store');
});