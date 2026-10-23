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
    // centers trc and wcc
    Route::get('/temporary-rescue-center', 'trc')->name('trc');
    Route::get('/working-children-center', 'wcc')->name('wcc');

    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'submitContact')->middleware('throttle:10,1')->name('contact.submit');

    Route::get('/volunteer', 'volunteer')->name('volunteer');
    Route::get('/partner-with-us', 'partner')->name('partner');
    // programs detail
    Route::get('programs/{slug}', 'allprograms')->name('programs.show');
    // stories index + detail
    Route::get('/stories', 'stories')->name('stories');
    Route::get('stories/{slug}', 'allstories')->name('frontend.stories');
    Route::get('/privacy-policy', 'privacy')->name('privacy');
    Route::get('/terms', 'terms')->name('terms');
    // blogs articles
    Route::get('/blogs', 'blogsIndex')->name('blogs');
    Route::get('/blogs/{slug}', 'blog')->name('frontend.blogs.show');

    // publications
    Route::get('/publications', 'publications')->name('publication');

    Route::get('/partners', 'partners')->name('partners');

    Route::get('/our-team', 'team')->name('team');

    Route::get('/donate', 'donate')->name('donate');

    Route::get('/events', 'events')->name('events');
    Route::get('/events/{slug}', 'event')->name('frontend.events.show');

});
