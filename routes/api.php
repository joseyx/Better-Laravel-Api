<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FullUserDataController;
use App\Http\Controllers\SalaDeCineController;
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
    Route::post('sala/create', [SalaDeCineController::class, 'create']);
    Route::post('sala/update/{id}', [SalaDeCineController::class, 'update']);
    Route::get('sala/{id}', [SalaDeCineController::class, 'show']);
    Route::get('salas', [SalaDeCineController::class, 'index']);
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
