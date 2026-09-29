<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// route group for frontend
Route::controller(FrontendController::class)->group(function () {

    Route::get('/', 'index')->name('home');

    Route::get('/about', 'about')->name('about');
    Route::get('/mission', 'mission')->name('mission');
    Route::get('/vision', 'vision')->name('vision');

    Route::get('/programs', 'programs')->name('programs');
    Route::get('/projects', 'projects')->name('projects');

    Route::get('/get-involved', 'getInvolved')->name('get-involved');

    Route::get('/contact', 'contact')->name('contact');

    Route::get('/privacy-policy', 'privacy')->name('privacy');
    Route::get('/terms', 'terms')->name('terms');

});
