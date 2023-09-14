<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Route::get('/auth/github', [AuthController::class, 'redirectToProvider']);

Route::get('/auth/callback', [AuthController::class, 'handleProviderCallback']);

Route::get('/upload', function() {
    return view('upload');
})->middleware('auth');

Route::post('/upload', [FileController::class, 'handleUpload'])->middleware('auth');

Route::get('/profilo', [AuthController::class, 'index'])->middleware('auth');
Route::post('/profilo', [AuthController::class, 'update'])->name('profilo.update')->middleware('auth');
