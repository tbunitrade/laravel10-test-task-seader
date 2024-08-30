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
// Маршрут для загрузки изображения
// Показываем форму загрузки
Route::get('/upload-form', function () {return view('upload'); });

//Route::post('/upload-image', [ImageController::class, 'upload']); // Загружаем и обрабатываем изображение
Route::post('/upload-image', [ImageController::class, 'upload'])->middleware(['auth.token']);

//Route::get('/test-api-key', function () {
//    return response()->json(['api_key' => env('TINIFY_API_KEY')]);
//});
//
//Route::get('/test-env', function () {
//    Log::info('Environment variables', $_ENV);
//    return response()->json(['message' => 'Check logs for environment variables.']);
//});
//
//Route::post('/test-upload', function (Illuminate\Http\Request $request) {
//    $token = $request->header('X-CSRF-TOKEN');
//    Log::info('Received token:', ['token' => $token]);
//    return response()->json([
//        'message' => 'Received',
//        'token' => $token,
//        'api_key' => env('TINIFY_API_KEY'),
//    ]);
//});



Route::get('/users', function () {
    Log::info('get users token:');
    return view('users');
});

//Route::get('/api/users', [UserController::class, 'index']);
//Route::post('/api/users', [UserController::class, 'store']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
