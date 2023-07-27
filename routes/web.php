<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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

Route::get('/posts/{slug}', [PostController::class, 'show']);

Route::view('/contact', 'contact');
Route::view('/about', 'about');
Route::view('/login', 'login');