<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoreIdentityController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticeController;
use App\Models\Activity;
use App\Http\Controllers\ProfileController;
use App\Models\Notice;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/our-activities', function () {
    $activities = Activity::with('category')->get();
    return Inertia::render('Activities',[
        'activities'  => $activities,  
    ]);
})->name('activities');

Route::get('/blog', function () {
    return Inertia::render('Blog');
})->name('blog');

Route::get('/notice', function () {
    $notice = Notice::with('category')->get();
    return Inertia::render('Notice',[
       'notice'  => $notice,   
    ]);

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
    return Inertia::render('BlogPost');
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

Route::post('/contact', [ContactController::class, 'contactsubmit'])->name('contact.submit');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('activites', ActivitiesController::class);
    Route::resource('blogpost', BlogController::class);
    Route::resource('photos', GalleryController::class);
    Route::resource('notices', NoticeController::class);
    Route::resource('contactlist', ContactController::class);

    Route::get('/admin/home', [HomeController::class, 'homeadmin'])->name('home.admin');

    Route::post('/slide/update', [HomeController::class, 'update'])->name('slide.update');
    
    Route::resource('core-identities', CoreIdentityController::class);
    Route::resource('/features', FeatureController::class);


});

require __DIR__.'/auth.php';
