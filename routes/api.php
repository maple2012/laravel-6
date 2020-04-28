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


Route::prefix('v1')
    ->namespace('Api')
    ->name('api.v1.')
    ->group(function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        // 分类列表
        Route::get('categories', 'CategoriesController@index')
            ->name('categories.index');
        // 话题列表，详情
        Route::resource('topics', 'TopicsController')->only([
            'index', 'show'
        ]);
        Route::middleware('jwt.auth')->group(
            function () {
                Route::post('logout', 'AuthController@logout');
                Route::post('refresh', 'AuthController@refresh');
                Route::post('me', 'AuthController@me');
                Route::post('user', 'AuthController@getAuthUser');
                // 发布话题
                Route::resource('topics', 'TopicsController')->only([
                    'store', 'update', 'destroy'
                ]);
            });
    });
