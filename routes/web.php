<?php
//import \App\Http\Controllers\CsvController.php;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'CsvController@store');

Route::get('/csv', 'CsvController@store');

Route::get('/planes/', 'CsvController@getAllPlanes');

Route::get('/planes/{id}', 'CsvController@getPlanes');
