<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/activities', function () {
    return Inertia::render('Activities');
})->name('activities');

Route::get('/blog', function () {
    return Inertia::render('Blog');
})->name('blog');

Route::get('/notice', function () {
    return Inertia::render('Notice');
})->name('notice');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/user', function () {
    return Inertia::render('User/Profile');
})->name('user.profile');


// Add this route for the full gallery page
Route::get('/gallery', function () {
    return Inertia::render('Gallery');
})->name('gallery');


Route::get('/blog', function () {
    return Inertia::render('Blog/Index');
})->name('blog');

Route::get('/blog/{slug}', function ($slug) {
    return Inertia::render('Blog/Show', ['slug' => $slug]);
})->name('blog.show');

// Add these routes for CTA links
Route::get('/donate', function () {
    return Inertia::render('Donate');
})->name('donate');

Route::get('/volunteer', function () {
    return Inertia::render('Volunteer');
})->name('volunteer');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
