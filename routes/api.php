<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\TokenController;
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

Route::post('/token', [TokenController::class, 'create']);

Route::middleware('auth:sanctum')->get('/user/tasks', [TaskController::class, 'user_tasks']);


