<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\JobController;
use App\Http\Controllers\Client\VerificationController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::controller(HomeController::class)
    ->group(function () {
        Route::get('', 'index')->name('home');
        Route::get('/locale/{locale}', 'language')->name('language')->where('locale', '[a-z]+');
    });

Route::controller(JobController::class)
    ->group(function () {
        Route::get('/job/{slug}', 'job')->name('job')->where('slug', '[A-Za-z0-9-]+');
        Route::get('/category/{slug}', 'category')->name('category')->where('slug', '[A-Za-z0-9-]+');

    });


Route::controller(VerificationController::class)
    ->middleware(['guest:customer_web', 'throttle:3,1'])
    ->group(function () {
        Route::get('/verification', 'create')->name('verification');
        Route::post('/verification', 'store');
    });

Route::controller(LoginController::class)
    ->middleware('guest:customer_web')
    ->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store');
    });

Route::controller(LoginController::class)
    ->middleware('auth:customer_web')
    ->group(function () {
        Route::post('/logout', 'destroy')->name('logout');
    });