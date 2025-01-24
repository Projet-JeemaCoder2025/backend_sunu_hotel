<?php

use App\Http\Controllers\ChambreController;
use App\Http\Controllers\UserController;
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


Route::post('/register', [UserController::class, 'register']);
Route::post('/register-receptionist', [UserController::class, 'registerReceptionist']);
Route::post('/login', [UserController::class, 'login']);



Route::middleware('auth:api')->group(function () {
        Route::get('/chambres', [ChambreController::class, 'index']); // Liste des chambres
    Route::post('/chambres', [ChambreController::class, 'store']); // Ajouter une chambre
    Route::put('/chambres/{id}', [ChambreController::class, 'update']); // Modifier une chambre
    Route::delete('/chambres/{id}', [ChambreController::class, 'destroy']); // Su
});