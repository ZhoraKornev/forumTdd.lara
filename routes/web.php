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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads', 'ThreadsController@index');
Route::get('/threads/create', 'ThreadsController@create');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
Route::delete('/threads/{channel}/{thread}', 'ThreadsController@destroy');
Route::post('threads', 'ThreadsController@store');
Route::get('/threads/{channel}/', 'ThreadsController@index');

Route::delete('/replies/{reply}/', 'RepliesController@destroy');
Route::patch('/replies/{reply}/', 'RepliesController@update');

Route::post('threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::post('replies/{reply}/favorite', 'FavoriteController@store');
Route::delete('replies/{reply}/favorite', 'FavoriteController@destroy');

Route::get('/profiles/{user}/', 'ProfilesController@show')->name('profile');
