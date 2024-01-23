<?php

use App\Http\Controllers\Api\AllUsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route to Home Page
Route::get('allusers', [AllUsersController::class,'index']);

//Route to Store in Database
Route::post('allusers', [AllUsersController::class,'store']);

//Route to Add User
Route::get('allusers/{id}', [AllUsersController::class,'show']);

//Route to Edit User
Route::get('allusers/{id}/edit', [AllUsersController::class,'edit']);

//Route to Update User
Route::put('allusers/{id}/edit', [AllUsersController::class,'update']);

//Route to Delete User
Route::delete('allusers/{id}/delete', [AllUsersController::class,'destroy']);