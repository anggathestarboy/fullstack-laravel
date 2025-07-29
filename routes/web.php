<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;



Route::get('/', [HomeController::class, 'index'])->name('user.home');



Route::prefix('/admin')->group(function() {
    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
    });
});


Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);




Route::controller(AdminAuthorController::class)->group(function () {
    Route::get('/author', 'index')->name('admin.author');
    Route::post('/author', 'store')->name('admin.author.store');
    Route::patch('/author/{author_id}', 'update')->name('admin.author.update');
    Route::delete('/author/{author_id}', 'delete')->name('admin.author.delete');
});


    Route::get('/publisher', [PublisherController::class, 'index'])->name('admin.publisher');
    Route::post('/publisher/store', [PublisherController::class, 'store'])->name('admin.publisher.store');
    Route::patch('/publisher/update/{publisher_id}', [PublisherController::class, 'update'])->name('admin.publisher.update');
    Route::delete('/publisher/delete/{publisher_id}', [PublisherController::class, 'delete'])->name('admin.publisher.delete');

