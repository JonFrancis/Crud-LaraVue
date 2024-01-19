<?php

use App\Http\Controllers\Api\AllUsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('allusers', [AllUsersController::class,'index']);
Route::post('allusers', [AllUsersController::class,'store']);
Route::get('allusers/{id}', [AllUsersController::class,'show']);
Route::get('allusers/{id}/edit', [AllUsersController::class,'edit']);
Route::put('allusers/{id}/edit', [AllUsersController::class,'update']);
Route::delete('allusers/{id}/delete', [AllUsersController::class,'destroy']);