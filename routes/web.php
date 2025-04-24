<?php

use App\Http\Controllers\Backend\Admin\AdminManagement\AdminController;
use App\Http\Controllers\Backend\Admin\Auth\LoginController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;
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

// Admin Guest Routes

Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
   Route::controller(LoginController::class)->group(function(){
        Route::get('/login','showLoginForm')->name('login');
        Route::post('/login','loginCheck')->name('login');
   });
});

// Admin Auth Routes
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::controller(LoginController::class)->group(function(){
        Route::get('/logout','logout')->name('logout');
   });
    Route::get('/dashboard',[AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'admin-management', 'as' => 'am.'], function () {
        Route::resource('admin', AdminController::class);
    });
});


