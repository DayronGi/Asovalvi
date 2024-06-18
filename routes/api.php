<?php

use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ObligationController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(TaskController::class)->group(function() {
    Route::get('/tasks', 'list');
    Route::post('/tasks', 'store');
});

Route::controller(MeetingController::class)->group(function() {
    Route::get('/meetings', 'list');
    Route::post('/meetings', 'store');
});

Route::controller(ObligationController::class)->group(function() {
    Route::get('/obligations', 'list');
    Route::post('/obligations', 'store');
});