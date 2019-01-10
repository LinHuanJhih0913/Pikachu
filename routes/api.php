<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/returnurl', 'PaymentController@returnurl');
Route::post('/register', 'API\RegistrationController@store')->middleware('cors');
Route::post('/login', 'API\LoginController@store');
Route::post('/autologin', 'API\LoginController@autologin');
Route::delete('/logout', 'API\LoginController@destory');

Route::post('/play', 'API\PlayController@play');

Route::get('/games', 'API\GamesController@index');
Route::get('/achievement', 'API\AchievementController@index');
Route::post('/achievement', 'API\AchievementController@store');
Route::get('/achievelist', 'API\AchieveListController@index');

Route::get('/detail', 'API\TransationController@index');

Route::get('/balance', 'UserController@getBalance');

Route::get('/shop/{game_id}', 'API\ShopController@index');
Route::post('/shop', 'API\ShopController@store');
Route::delete('/shop', 'API\ShopController@destory');