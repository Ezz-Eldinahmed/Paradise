<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/explore', [ExploreController::class, 'index']);

    Route::get('/Notifications', [UserNotificationController::class, 'show']);
});

Route::middleware('auth')->prefix('tweets')->group(function () {

    Route::post('', [TweetController::class, 'store']);

    Route::get('', [TweetController::class, 'index']);

    Route::put('/{tweet}', [TweetController::class, 'update']);

    Route::post('/{tweet}/comment', [CommentController::class, 'store']);

    Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edited');

    Route::put('/{comment}/update', [CommentController::class, 'update']);

    Route::get('/{comment}/delete', [CommentController::class, 'delete']);

    Route::post('/{tweet}/like', [LikesController::class, 'like']);

    Route::post('/{tweet}/dislike', [LikesController::class, 'dislike']);

    Route::get('/{tweet}/edited', [TweetController::class, 'edit'])->name('tweets.edit');

    Route::get('/{tweet}/destroy', [TweetController::class, 'destroy'])->name('tweets.destroy');
});

Route::middleware('auth')->prefix('profile')->group(function () {
    Route::post('/{user:username}/follow', [FollowController::class, 'store']);

    Route::get('/{user:username}', [ProfileController::class, 'show'])->name('profile');

    // Route::get('/{user:username}/destroy', [ProfileController::class, 'destroy']);

    Route::get('/{user:username}/edit', [ProfileController::class, 'edit'])
        ->middleware('can:update,user');

    Route::patch('/{user:username}', [ProfileController::class, 'update'])
        ->middleware('can:update,user');
});


Route::get('login/facebook', [LoginController::class, 'redirectToProvider']);

Route::get('login/facebook/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('login/google', [LoginController::class, 'GoogleRedirect']);

Route::get('login/google/callback', [LoginController::class, 'GoogleRedirectCallback']);
