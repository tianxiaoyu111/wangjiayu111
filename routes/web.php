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

Route::get('/', 'FileController@index');
Route::any('up', 'FileController@showUploaded');
Route::any('fix', 'FileController@showFixed');
Route::get('down/{filename}', 'FileController@download');
Route::get('clean', 'FileController@cleanUp');
//Route::get('dofix', 'FileController@doFix');
