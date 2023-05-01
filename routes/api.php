<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CustomerController;
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


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('customers/search', [CustomerController::class,'search']);
Route::apiResource('customers', CustomerController::class);

Route::get('contacts/search', [ContactController::class,'search']);
Route::apiResource('contacts', ContactController::class);

