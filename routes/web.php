<?php

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

# Return View
// Route::get('/', function () {
//     return view('welcome');
// });

# Return View if not call a controller
// Route::view('/', 'welcome');

Route::get('/', HomeController::class);

// Posts
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts/store', [PostController::class, 'store']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit']);
Route::patch('/posts/{post:slug}/edit', [PostController::class, 'update']);
Route::delete('/posts/{post:slug}/delete', [PostController::class, 'destroy']);

// Categories
Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

// Tags
Route::get('/tags/{tag:slug}', [TagController::class, 'show']);

Route::view('/contact', 'contact');
Route::view('/about', 'about');
Route::view('/login', 'login');