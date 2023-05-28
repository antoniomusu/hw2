<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', 'App\Http\Controllers\LoginController@redirect_login');
Route::post('login', 'App\Http\Controllers\LoginController@do_login');
Route::get('login', 'App\Http\Controllers\LoginController@login');

Route::get('entry', 'App\Http\Controllers\LoginController@entry');
Route::post('entry', 'App\Http\Controllers\LoginController@signup');

Route::get('home', 'App\Http\Controllers\HomeController@home');
Route::get('restoreEvents', 'App\Http\Controllers\HomeController@restoreEvents');
Route::get('logout', 'App\Http\Controllers\LoginController@logout');

Route::get('profile/{username}', 'App\Http\Controllers\HomeController@profile');
Route::post('updateBio', 'App\Http\Controllers\ProfileController@updateBio');
Route::get('savedAnime/{user}', 'App\Http\Controllers\ProfileController@restoreSaves');
Route::get('changeImage', 'App\Http\Controllers\ProfileController@changeImage');
Route::get('saveImage', 'App\Http\Controllers\ProfileController@saveImage');

Route::get('searchAnime', 'App\Http\Controllers\AnimeController@searchAnime');
Route::get('anime/{animeID}', 'App\Http\Controllers\AnimeController@showAnime');
Route::get('addAnime', 'App\Http\Controllers\AnimeController@addSaved');
Route::get('restoreComments', 'App\Http\Controllers\AnimeController@restoreComments');
Route::post('addComment', 'App\Http\Controllers\AnimeController@addComment');