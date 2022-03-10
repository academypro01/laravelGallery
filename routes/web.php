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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('backend')->namespace('App\Http\Controllers\Backend')->middleware([])->group(function () {
    Route::get('dashboard', 'MainController@index')->name('backend.dashboard.index');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::post('upload', 'PhotoController@upload')->name('photo.upload');
});
