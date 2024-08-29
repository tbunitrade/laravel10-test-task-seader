<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']); // Получить список всех пользователей
Route::post('/users', [UserController::class, 'store']); // Добавить нового пользователя
Route::get('/positions', [PositionController::class, 'index']);
Route::post('/upload-image', [ImageController::class, 'upload']);
