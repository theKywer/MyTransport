<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FuelController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\DetailController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\TransportController;

Route::middleware(['api'])->group(function () {
    // Регистрация
    Route::post('/register', [AuthController::class, 'register']);
    // Аутентификация
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'api'])->group(function () {
        // Авторизация
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
        
        // Транспорт
        Route::post('/transport', [TransportController::class, 'create']);
        Route::put('/transport', [TransportController::class, 'update']);
        Route::get('/transport', [TransportController::class, 'get']);
        Route::delete('/transport/{id}', [TransportController::class, 'delete']);

        // События
        Route::post('/event', [EventController::class, 'create']);
        Route::put('/event', [EventController::class, 'update']);
        Route::get('/event', [EventController::class, 'get']);
        Route::delete('/event/{id}', [EventController::class, 'delete']);
        
        // Детали
        Route::post('/event/detail', [DetailController::class, 'create']);
        Route::put('/event/detail', [DetailController::class, 'update']);
        Route::get('/event/detail', [DetailController::class, 'get']);
        Route::delete('/event/detail/{id}', [DetailController::class, 'delete']);

        // Ресурсы
        Route::post('/event/resource', [ResourceController::class, 'create']);
        Route::put('/event/resource', [ResourceController::class, 'update']);
        Route::get('/event/resource', [ResourceController::class, 'get']);
        Route::delete('/event/resource', [ResourceController::class, 'delete']);

        // Заправки
        Route::post('/fuel', [FuelController::class, 'create']);
        Route::put('/fuel', [FuelController::class, 'update']);
        Route::get('/fuel', [FuelController::class, 'get']);
        Route::delete('/fuel/{id}', [FuelController::class, 'delete']);
    });

});
