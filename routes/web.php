<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
// Route::get('/listing',[])
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// use Illuminate\Support\Facades\Route;

Route::middleware([AdminMiddleware::class])->group(function () {
    // Route::get('/admin/dashboard', function () {
    //     return "Welcome to Admin Dashboard";
    // });
    Route::get('/admin/dashboard', [UserController::class, 'AdminDashboardPage']);
    Route::get('/listProject', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/projects/delete/{id}', [ProjectController::class, 'delete'])->name('projects.delete');

    Route::resource('/employees', EmployeeController::class);

});

Route::middleware([UserMiddleware::class])->group(function () {
    // Route::get('/user/dashboard', function () {
    //     return "Welcome to user Dashboard";
    // });
    Route::get('/user/dashboard', [UserController::class, 'UserDashboardPage']);
});

Route::get('/testPage', [UserController::class, 'testFunction']); // Get all users

require __DIR__.'/auth.php';
