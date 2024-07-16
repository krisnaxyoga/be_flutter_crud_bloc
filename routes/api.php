<?php

use Illuminate\Http\Request;
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


Route::prefix('people')->group(function () {
    Route::post('/register', [App\Http\Controllers\Api\PeopleController::class, 'register']);
    Route::get('/datapeople', [App\Http\Controllers\Api\PeopleController::class, 'index']);
});
