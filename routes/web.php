<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Posts
Route::prefix('posts')->middleware('auth')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('posts.index')->withoutMiddleware('auth');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/store', [PostController::class, 'store']);
    Route::get('/{post:slug}', [PostController::class, 'show'])->withoutMiddleware('auth');
    Route::get('/{post:slug}/edit', [PostController::class, 'edit']);
    Route::patch('/{post:slug}/edit', [PostController::class, 'update']);
    Route::delete('/{post:slug}/delete', [PostController::class, 'destroy']);
});


// Categories
Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

// Tags
Route::get('/tags/{tag:slug}', [TagController::class, 'show']);

Route::view('/contact', 'contact');
Route::view('/about', 'about');
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
