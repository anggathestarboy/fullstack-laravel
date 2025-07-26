<?php

use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class, 'index'])->name('user.home');



Route::prefix('/admin')->group(function() {
    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
    });
});


Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
