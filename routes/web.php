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

Route::get('/', function () {
    if(auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::post('/login/post', 'App\Http\Controllers\UserController@postLogin')->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');

    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('profile');
    Route::get('/profile/get', 'App\Http\Controllers\UserController@getProfile')->name('profile.get');
    Route::post('/profile/save', 'App\Http\Controllers\UserController@saveProfile')->name('profile.save');

    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users');
    Route::get('/users/get', 'App\Http\Controllers\UserController@get')->name('users.get');
    Route::post('/user/store', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::get('/user/{id}/edit', 'App\Http\Controllers\UserController@edit')->name('user.edit');
    Route::put('/user/update', 'App\Http\Controllers\UserController@update')->name('user.update');
    Route::delete('/user/{id}/destroy', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
});