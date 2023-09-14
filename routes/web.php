<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth', function () {
    return view('login');
});

Route::get('/auth/github', [AuthController::class, 'redirectToProvider']);

Route::get('/auth/callback', [AuthController::class, 'handleProviderCallback']);

Route::get('/upload', function() {
    return view('upload');
});

Route::post('/upload', [FileController::class, 'handleUpload'])->middleware('auth');