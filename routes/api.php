<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
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

Route::post('auth', [AuthController::class, 'login'])->withoutMiddleware(['jwt.auth']);

Route::group(['middleware' => ['api']], function () {
    Route::post('lead', [LeadController::class, 'store']);
    Route::get('lead/{id}', [LeadController::class, 'show']);
    Route::get('leads', [LeadController::class, 'index']);
});
