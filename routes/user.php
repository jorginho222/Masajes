<?php

use App\Models\Booking;
use App\Models\BookingOrder;
use Illuminate\Http\Request;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\EnrollmentController;
use App\Http\Controllers\User\BookingOrderController;
use App\Http\Controllers\User\EnrollmentOrderController;
use App\Http\Controllers\User\BookingOrderPaymentController;
use App\Http\Controllers\User\EnrollmentOrderPaymentController;


/*
|--------------------------------------------------------------------------
| user Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Profile
Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

// Comments
Route::post('/blog/posts/{post}', [CommentController::class, 'store'])->name('comments.store');

// Bookings
Route::resource('bookings', BookingController::class);

// Enrollments
Route::get('enrollments/start/{course}', [EnrollmentController::class, 'start'])->name('start.enrollment');
Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');

// Orders & Payments
Route::post('bookings-orders-validation', [BookingOrderController::class, 'validation'])->name('bookings.orders.validation');
Route::post('bookings-orders', [BookingOrderController::class, 'store'])->name('bookings.orders');
Route::get('bookings/orders/{order}/payments/create', [BookingOrderPaymentController::class, 'create'])->name('bookings.orders.payments.create');
Route::get('bookings/orders/{order}/payments/pay', [BookingOrderPaymentController::class, 'pay'])->name('bookings.orders.payments.pay');

Route::post('enrollments-orders-validation', [EnrollmentOrderController::class, 'validation'])->name('enrollments.orders.validation');
Route::post('enrollments-orders/{course}', [EnrollmentOrderController::class, 'store'])->name('enrollments.orders');
Route::get('enrollments/orders/{order}/payments/create', [EnrollmentOrderPaymentController::class, 'create'])->name('enrollments.orders.payments.create');
Route::get('enrollments/orders/{order}/payments/pay', [EnrollmentOrderPaymentController::class, 'pay'])->name('enrollments.orders.payments.pay');

// Payments results
Route::get('/bookings-success', function () {
    return view('user.bookings.success');
})->name('booking.success');

Route::get('/enrollments/success', function () {
    return view('user.enrollments.success');
})->name('enrollment.success');

Route::get('/bookings/pending', function () {
    return view('user.bookings.pending');
})->name('booking.pending');

Route::get('/failure', function (BookingOrder $order) {
    return view('user.bookings.failure')->with(['order' => $order->id]);
})->name('failure');




