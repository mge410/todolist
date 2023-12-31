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

Route::group(['prefix' => 'main', 'middleware' => 'auth'], function () {
    Route::get('/', App\Http\Controllers\Main\IndexController::class)->name('list.index');
    Route::post('/store', App\Http\Controllers\Main\StoreController::class)->name('list.store');

    Route::group(['middleware' => 'admin'], function (){
        Route::patch('/update/{list_id}', App\Http\Controllers\Main\UpdateController::class)->name('list.update');
        Route::delete('/destroy/{list_id}', App\Http\Controllers\Main\DestroyController::class)->name('list.destroy');

        Route::group(['prefix' => '{list_id}/task'], function () {
            Route::get('/', App\Http\Controllers\Task\IndexController::class)->name('task.index');
            Route::post('/store', App\Http\Controllers\Task\StoreController::class)->name('task.store');
            Route::patch('/update/{task_id}', App\Http\Controllers\Task\UpdateController::class)->name('task.update');
            Route::delete('/destroy/{task_id}', App\Http\Controllers\Task\DestroyController::class)->name('task.destroy');

            Route::group(['prefix' => '{task_id}/tag'], function () {
                Route::post('/store', App\Http\Controllers\Tag\StoreController::class)->name('tag.store');
                Route::delete('/destroy/{tag_id}', App\Http\Controllers\Tag\DestroyController::class)->name('tag.destroy');
            });
        });
    });
});

Auth::routes();
