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

/** Service REST actions */
Route::get('/services', 'ServiceController@index');
Route::get('/services/{service}', 'ServiceController@show');
Route::post('/services', 'ServiceController@store');
Route::put('/services/{service}', 'ServiceController@update');
Route::delete('/services/{service}', 'ServiceController@destroy');

/** Set statuses for services and service groups */
Route::put('/services/{service}/setstatus/{status}', 'ServiceController@setStatus');
Route::put('/services/{service}/resetstatus', 'ServiceController@resetStatus');
Route::put('/servicegroups/{serviceGroup}/setstatus/{status}', 'ServiceGroupController@setStatus');
Route::put('/servicegroups/{serviceGroup}/resetstatus', 'ServiceGroupController@resetStatus');

/** Service group REST actions */
Route::get('/servicegroups', 'ServiceGroupController@index');
Route::post('/servicegroups', 'ServiceGroupController@store');
Route::post('/servicegroups/{serviceGroup}/allocate/{service}', 'ServiceGroupController@allocate');
Route::post('/servicegroups/{serviceGroup}/deallocate/{service}', 'ServiceGroupController@deallocate');
Route::put('/servicegroups/{serviceGroup}', 'ServiceGroupController@update');
Route::delete('/servicegroups/{serviceGroup}', 'ServiceGroupController@destroy');

/** Status REST actions */
Route::get('/statuses', 'StatusController@index');
Route::post('/statuses', 'StatusController@store');
Route::put('/statuses/{status}', 'StatusController@update');
Route::delete('/statuses/{status}', 'StatusController@destroy');

/** Response REST actions */
Route::get('/responses', 'ResponseController@index');
Route::post('/responses', 'ResponseController@store');
Route::put('/responses/{response}', 'ResponseController@update');
Route::delete('/responses/{response}', 'ResponseController@destroy');