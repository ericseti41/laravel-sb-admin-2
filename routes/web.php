<?php

use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'SiswaController@awal');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::resource('/siswa', SiswaController::class)->middleware('auth');
Route::resource('/sekolah', SekolahController::class)->middleware('auth');
Route::resource('/users', UsersController::class)->middleware('auth');
Route::get('/cari', 'SiswaController@cari')->name('cari');

Route::get('/about', function () {
    return view('about');
})->name('about');
