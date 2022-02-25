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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'Auth\UserController@index')->name('users');
Route::get('/weights', 'WeightController@index')->name('weights.index');
Route::get('/weights/create', 'WeightController@create')->name('weights/create');
Route::post('/weights', 'WeightController@store')->name('weights.store');


