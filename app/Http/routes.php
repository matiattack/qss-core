<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/url-diferente', function(){ echo 'Bonsoir QSS-CORE!'; });

Route::group(['middleware' => ['cors']], function () {

    Route::get('/', function(){ echo 'Bonsoir QSS-CORE!'; });

    Route::group(['prefix' => 'user'], function() {
        Route::post('/{id}/follow', ['uses' => 'UserController@follow']);
        Route::get('{id}/followings', ['uses' => 'UserController@followings']);
        Route::get('{id}/followers', ['uses' => 'UserController@followers']);
    });
    Route::resource('/user', 'UserController');

    Route::group(['prefix' => 'login'], function() {
        Route::post('/', ['uses' => 'LoginController@login']);
        Route::get('authenticated', ['uses' => 'LoginController@getAuthenticatedUser']);
    });

    Route::group(['prefix' => 'disciplines'], function() {
        Route::get('categories', ['uses' => 'DisciplineController@categories']);
        Route::post('{id}/follow', ['uses' => 'DisciplineController@follow']);
        Route::get('{id}/publications', ['uses' => 'DisciplineController@publications']);
    });

    Route::resource('/disciplines', 'DisciplineController');

    Route::group(['prefix' => 'image'], function() {
        Route::get('user/{id}', ['uses' => 'ImageController@byUser']);
        Route::post('set-profile', ['uses' => 'ImageController@setProfile']);
    });
    Route::resource('/image', 'ImageController');


    Route::group(['prefix' => 'schedule'], function() {
        Route::get('user/{idUser}', ['uses' => 'ScheduleController@byUser']);
    });
    Route::resource('/schedule', 'ScheduleController');

    Route::group(['prefix' => 'location'], function() {
        Route::get('user/{idUser}', ['uses' => 'LocationController@byUser']);
    });
    Route::resource('/location', 'LocationController');

    Route::group(['prefix' => 'user-diffusion'], function() {
        Route::post('{diffusion}/react/{reaction}', ['uses' => 'UserDiffusionController@react']);
        Route::post('validate-uri', ['uses' => 'UserDiffusionController@validateUri']);
        Route::get('user/{idUser}', ['uses' => 'UserDiffusionController@byUser']);
        Route::post('{diffusion}/comment', ['uses' => 'UserDiffusionController@comment']);
        Route::get('{diffusion}/comment', ['uses' => 'UserDiffusionController@diffusionComments']);
    });
    Route::resource('/user-diffusion', 'UserDiffusionController');

    Route::group(['prefix' => 'event'], function() {
    });
    Route::resource('/event', 'EventController');
});
