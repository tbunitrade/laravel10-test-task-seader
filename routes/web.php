<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {return view('welcome');});
Route::get('/upload-form', function () {return view('upload'); });
//Route::post('/upload-image', [ImageController::class, 'upload'])->middleware(['auth.token']);
Route::post('/upload-image', [ImageController::class, 'upload']); //for heroku only


Route::get('/users', function () {
    Log::info('get users token:');
    return view('users');
});


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
