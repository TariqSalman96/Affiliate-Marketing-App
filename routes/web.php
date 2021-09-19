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

Auth::routes(['reset' => false]);

// user protected routes
Route::group(['middleware' => ['auth', 'user']], function () {
    Route::get('/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
    Route::get('/',     [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
});

// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'Admin'], function () {
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('AdminHome');
    Route::get('/',     [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('AdminHome');
});
