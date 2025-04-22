<?php

use App\Http\Controllers\Backend\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

// Frontend Routes
Route::group(['as' => 'f.'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});

// User Auth Routes
Route::group(['middleware' => 'auth:web', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/dashboard',[UserDashboardController::class, 'dashboard'])->name('dashboard');
});

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard',[UserDashboardController::class, 'dashboard'])->name('dashboard');
});


