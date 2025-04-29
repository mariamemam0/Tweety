<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FollowController;
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

Route::post('/profile/{user:username}/follow', function (User $user) {
    auth()->user()->following()->toggle($user);
    return back();
})->name('follow');

Route::put('/profile/{user}/avatar', [AvatarController::class, 'store'])->name('profile.avatar');


//show followers
Route::get('/profile/{user:username}/followers',[FollowController::class,'followers'])->name('profile.followers');
//show followings
Route::get('/profile/{user:username}/followings',[FollowController::class,'followings'])->name('profile.following');
require __DIR__.'/auth.php';
