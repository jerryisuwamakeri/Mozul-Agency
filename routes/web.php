<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubmissionsController;
use App\Http\Controllers\Admin\ReviewController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services.index');
Route::get('/why-us', [HomeController::class, 'whyUs'])->name('why-us.index');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Auth routes
require __DIR__.'/auth.php';

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('blog', BlogPostController::class)->except(['show']);
    Route::resource('blog-categories', BlogCategoryController::class)->except(['create', 'show', 'edit', 'update']);

    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::put('settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');

    Route::resource('courses', CourseController::class)->except(['show']);

    Route::get('submissions', [SubmissionsController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{submission}', [SubmissionsController::class, 'show'])->name('submissions.show');
    Route::delete('submissions/{submission}', [SubmissionsController::class, 'destroy'])->name('submissions.destroy');

    Route::resource('reviews', ReviewController::class)->except(['create', 'show', 'edit']);
});
