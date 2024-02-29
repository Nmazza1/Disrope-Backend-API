<?php

use App\Http\Controllers\APIController;
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


// User routes
Route::post('/ext/user', [APIController::class, 'setUser']);
Route::post('/ext/user/login', [APIController::class, 'getUser']);
Route::get('/ext/users', [APIController::class, 'getAllUsers']);

// Message routes
Route::post('/ext/message', [APIController::class, 'setMessage']);
Route::get('/ext/messages', [APIController::class, 'getAllMessages']);
Route::get('/ext/messages/{server_id}', [APIController::class, 'getMessagesByServerId']);

// Server routes
Route::get('/ext/servers', [APIController::class, 'getAllServers']);
