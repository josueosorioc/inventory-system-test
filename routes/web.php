<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\AuthorizationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthorizationController::class, 'login'])->name('login')->middleware('guest');
Route::post('validate-login', [AuthorizationController::class, 'validateLogin'])->name('validate.login');
Route::get('registro', [AuthorizationController::class, 'register'])->name('register')->middleware('guest');
Route::post('register-save', [AuthorizationController::class, 'registerSave'])->name('register.save');
Route::get('logout', [AuthorizationController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function () {
    
    Route::prefix('articulos')->group(function () {
        Route::get('/', [ArticuloController::class, 'index'])->name('list.articles');
        Route::get('list', [ArticuloController::class, 'data'])->name('list.articles.data');

    });
});
