<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\V1\UserFlightsController;


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

Route::get('flights/{user_id}', [UserFlightsController::class, 'firstAndLastFlights']);
Route::get('flights/{user_id}/all', [UserFlightsController::class, 'index']);
Route::post('flights/{user_id}', [UserFlightsController::class, 'store']);
