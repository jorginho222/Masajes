<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\CourseController;
use App\Http\Controllers\Panel\BookingController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\ServiceController;

/*
|--------------------------------------------------------------------------
| Panel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register panel routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "panel" middleware group. Now create something great!
|
*/

//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// CRUDs
Route::get('/bookings', [BookingController::class, 'index'])->name('panel.bookings.index');
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('panel.bookings.edit');
Route::post('bookings-validation', [BookingController::class, 'validation'])->name('panel.bookings.validation');
Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('panel.bookings.update');

Route::post('posts-validation', [PostController::class, 'validation'])->name('posts.validation');
Route::resource('posts', PostController::class);

Route::post('services-validation', [ServiceController::class, 'validation'])->name('services.validation');
Route::resource('services', ServiceController::class);

Route::post('courses-validation', [CourseController::class, 'validation'])->name('courses.validation');
Route::resource('courses', CourseController::class);
Route::get('/{course}/enrolled', [CourseController::class, 'showEnrolledUsers'])->name('panel.course.enrolled');

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users/admin/{user}', [UserController::class, 'toggleAdmin'])->name('users.admin.toggle');

Route::post('categories-validation', [CategoryController::class, 'validation'])->name('categories.validation');
Route::resource('categories', CategoryController::class);
