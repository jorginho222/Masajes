<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main
Route::get('/', [MainController::class, 'index'])->name('welcome');
Route::get('/blog', [MainController::class, 'blog'])->name('blog');
Route::get('/blog/posts/{post}', [MainController::class, 'post'])->name('post');
Route::get('{post}/comments', [MainController::class, 'fetchComments'])->name('comments');
Route::get('/courses', [MainController::class, 'courses'])->name('courses');
Route::get('/courses/{course}', [MainController::class, 'course'])->name('course');

Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::post('/contact-validation', [ContactController::class, 'validation'])->name('contact.validation');
Route::post('/send-mail', [ContactController::class, 'send'])->name('contact.send');
Route::get('/mail-sent', [ContactController::class, 'success'])->name('contact.success');

// Login
Route::get('/login-google', function() {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-callback', function() {
    $user = Socialite::driver('google')->user();

    $userExists = User::where('external_id', $user->id)->where('external_auth', 'google')->first();
    
    if($userExists) {
        Auth::login($userExists);
    } else {
        $userNew = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => 'google',
        ]);
        
        Auth::login($userNew);
    }
    
    return redirect()->route('welcome');
});

Route::get('/login-facebook', function() {
    return Socialite::driver('facebook')->redirect();
});

Route::get('/facebook-callback', function() {
    $user = Socialite::driver('facebook')->user();

    $userExists = User::where('external_id', $user->id)->where('external_auth', 'facebook')->first();
    
    if($userExists) {
        Auth::login($userExists);
    } else {
        $userNew = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => 'facebook',
        ]);
        
        Auth::login($userNew);
    }
    
    return redirect()->route('welcome');
});

require __DIR__.'/auth.php';
