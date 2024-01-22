<?php

use App\Http\Controllers\CepController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!|
*/
Route::get('/', [CepController::class, 'index']);
Route::post('/telas', [CepController::class, 'store']);
Route::get('/endereco', [CepController::class, 'updatedCep']);
Route::get('/telas/enderecoedit/{id}', [CepController::class, 'edit']);
Route::put('/telas/update/{id}', [CepController::class, 'update']);
Route::delete('/telas/{id}', [CepController::class, 'destroy']);