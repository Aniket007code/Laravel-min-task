<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']); // Get all users
    Route::post('/add-users', [UserController::class, 'store']); // Add user (Only Admin)
    Route::put('/edit-user/{id}', [UserController::class, 'update']); // Edit user
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy']); // Delete user (Make inactive)
});
Route::post('/login', [UserController::class, 'login']);