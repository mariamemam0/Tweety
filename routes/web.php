<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [TweetController::class, 'index'])->middleware('auth');
Route::post('/tweets',[TweetController::class,'store'])->middleware('auth');
Route::get('profile/{user:username}',[ProfileController::class,'show'])->name('profile')->middleware('auth');

Route::post('/profile/{user:username}/follow', [FollowController::class, 'follow'])->name('follow');

Route::put('/profile/{user}/avatar', [AvatarController::class, 'store'])->name('profile.avatar');


//show followers
Route::get('/profile/{user:username}/followers',[FollowController::class,'followers'])->name('profile.followers');
//show followings
Route::get('/profile/{user:username}/followings',[FollowController::class,'followings'])->name('profile.following');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');


Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::get('/test-mail', function () {
    Mail::raw('This is a test email!', function ($message) {
        $message->to('your_email@example.com') // Replace with your email
                ->subject('Test Email');
    });

    return 'Test email sent!';
});
require __DIR__.'/auth.php';
