<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayPlanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/me', [\App\Http\Controllers\Me\MeController::class, 'show']);

Route::post('login', \App\Http\Controllers\Auth\LoginController::class);
Route::post('logout', \App\Http\Controllers\Auth\LogoutController::class);
Route::post('register', \App\Http\Controllers\Auth\RegistroController::class);

Route::prefix('holiday-plans')->middleware('auth:sanctum')->group(function (){
    Route::get('', [HolidayPlanController::class, 'index']);
    Route::get('{id}', [HolidayPlanController::class, 'show']);
    Route::get('{id}/pdf', [HolidayPlanController::class, 'generatePDF']);
    Route::post('', [HolidayPlanController::class, 'register']);
    Route::put('{id}', [HolidayPlanController::class, 'update']);
    Route::delete('{id}', [HolidayPlanController::class, 'destroy']);
});

