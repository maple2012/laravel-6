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
Route::prefix('auth')->middleware('jwt.auth')->group(
   function () {
    Route::post('logout', 'Home\AuthController@logout');
    Route::post('refresh', 'Home\AuthController@refresh');
    Route::post('me', 'Home\AuthController@me');
    Route::post('getAuthUser', 'Home\AuthController@getAuthUser');
});
Route::post('auth/login', 'Home\AuthController@login');
Route::post('auth/register', 'Home\AuthController@register');
