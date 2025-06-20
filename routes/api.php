<?php

use App\Http\Controllers\API\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('send-message', [TelegramController::class, 'sendMessage']);
Route::post('send-photo', [TelegramController::class, 'sendPhoto']);
Route::post('send-document', [TelegramController::class, 'sendDocument']);
