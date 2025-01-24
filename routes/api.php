<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AvisController;

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

Route::post('/chambres', [ChambreController::class, 'store']);
Route::post('/reservations', [ReservationController::class, 'store']);
    
// AVIS
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/avis', [AvisController::class, 'index']); // Voir 
    Route::post('/avis', [AvisController::class, 'store']); // Ajouter 
    Route::put('/avis/{id}', [AvisController::class, 'update']); // Modifier 
    Route::delete('/avis/{id}', [AvisController::class, 'destroy']); // Supprimer
});