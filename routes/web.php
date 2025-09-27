<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::controller(JobController::class)->group(function () {
    Route::get('/', 'index')->name('job.index');
    Route::middleware('auth')->group(function () {
        Route::get('/jobs/create', 'create')->name('job.create');
        Route::post('/jobs/create', 'store')->name('job.store');
        Route::middleware('can:update,job')->group(function () {
            Route::get('/jobs/{job}/edit', 'edit')->name('job.edit');
            Route::put('/jobs/{job}', 'update')->name('job.update');
            Route::delete('/jobs/{job}', 'destroy')->name('job.destroy');
        });
    });
});

Route::get('/search', SearchController::class);

Route::get('/tags/{tag:name}', TagController::class);

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register.create')->middleware('guest');
    Route::post('/register', 'store')->name('register.store')->middleware('guest');
});

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->name('session.create')->middleware('guest');
    Route::post('login', 'store')->name('session.store')->middleware('guest');
    Route::delete('/logout', 'destroy')->name('session.destroy')->middleware('auth');
});
