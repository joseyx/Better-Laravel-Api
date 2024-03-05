<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\TrailerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;


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

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::post('user/{id}', [UserController::class, 'update']);
    Route::post('sala/create', [SalaController::class, 'create']);
    Route::post('sala/update/{id}', [SalaController::class, 'update']);
    Route::get('sala/{id}', [SalaController::class, 'show']);
    Route::get('salas', [SalaController::class, 'index']);
    Route::post('pelicula/create', [PeliculaController::class, 'store']);
    Route::get('peliculas', [PeliculaController::class, 'index']);
    Route::get('pelicula/{id}', [PeliculaController::class, 'show']);
    Route::delete('pelicula/delete/{id}', [PeliculaController::class, 'destroy']);
    Route::post('horario', [HorarioController::class, 'create']);
    Route::get('horarios', [HorarioController::class, 'index']);
    Route::get('horario/{id}', [HorarioController::class, 'show']);
    Route::post('entrada/{id}', [HorarioController::class, 'storeAsientos']);
    Route::get('trailers', [TrailerController::class, 'index']);
    Route::post('trailer', [TrailerController::class, 'create']);
    Route::delete('trailer/{id}', [TrailerController::class, 'destroy']);
    Route::get('qr', [HorarioController::class, 'testQr']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forgotPassword', [AuthController::class, 'forgotPassword']);
    Route::post('resetPassword', [AuthController::class, 'resetPassword']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::post('passwordReset', [AuthController::class, 'passwordReset']);

    });
});
