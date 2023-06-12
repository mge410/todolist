<?php

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'main', 'middleware' => ['auth']], function () {
    Route::get('/', App\Http\Controllers\Main\IndexController::class)->name('list.index');
    Route::post('/store', App\Http\Controllers\Main\StoreController::class)->name('list.store');
    Route::delete('/destroy/{id}', App\Http\Controllers\Main\DestroyController::class)->name('list.destroy');
});

Auth::routes();
