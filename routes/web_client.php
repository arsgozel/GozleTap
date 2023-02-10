<?php

use App\Http\Controllers\Client\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Client\Auth\RegisteredUserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\JobController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\CategoryController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::controller(RegisteredUserController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store');
    });


Route::controller(AuthenticatedSessionController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store');
    });


Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('logout');


Route::controller(HomeController::class)
    ->group(function () {
        Route::get('', 'index')->name('home');
        Route::get('/locale/{locale}', 'language')->name('language')->where('locale', '[a-z]+');
    });


Route::controller(JobController::class)
    ->prefix('/jobs')
    ->name('jobs.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/{slug}', 'show')->name('show')->where('slug', '[A-Za-z0-9-]+');
        Route::get('job/{slug}/favorite', 'favorite')->name('job.favorite')->where('slug', '[0-9A-Za-z-]+');
    });


Route::controller(ContactController::class)
    ->prefix('/contacts')
    ->name('contacts.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('', 'store')->name('store');
    });
