<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\RelationController;
use Illuminate\Support\Facades\Route;

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
    return view('post.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    // Route::post('/post/confirm', [PostController::class, 'confirm'])->name('post.confirm');
    Route::post('/post/complete', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/post/{post}/bookmark', [BookmarkController::class, 'store'])->name('bookmark');
    Route::delete('/post/{post}/unbookmark', [BookmarkController::class, 'destroy'])->name('unbookmark');

    Route::post('/user/{user}/follow', [RelationController::class, 'store'])->name('follow');
    Route::delete('/user/{user}/unfollow', [RelationController::class, 'destroy'])->name('unfollow');
    Route::get('followings', [UserController::class, 'followings'])->name('user.followings');
    Route::get('followers', [UserController::class, 'followers'])->name('user.followers');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts/search', [PostController::class, 'search'])->name('post.search');

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user', [UserController::class, 'update'])->name('user.update');   // {}を末尾に付けない理由は、他ユーザーのidを叩かれると、そのユーザーのプロフィールを更新されてしまう可能性があるため

require __DIR__ . '/auth.php';
