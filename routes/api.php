<?php


use App\Http\Controllers\API\ReelController;
use Illuminate\Support\Facades\Route;



Route::post('/reels/upload', [ReelController::class, 'upload']);
Route::get('/reels', [ReelController::class, 'index']);
Route::get('/reels/{id}', [ReelController::class, 'show']);
