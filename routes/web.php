<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GameMatchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';




//Dashboard Routes
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])
        ->name('superadmin.dashboard');







    // Player Routes
    Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
    Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
    Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');
    Route::get('/players/{player}/edit', [PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{player}', [PlayerController::class, 'update'])->name('players.update');
    Route::patch('/players/{player}', [PlayerController::class, 'update']);
    Route::delete('/players/{player}', [PlayerController::class, 'destroy'])->name('players.destroy');

    // Coach Routes
    Route::get('/coaches', [CoachController::class, 'index'])->name('coaches.index');
    Route::get('/coaches/create', [CoachController::class, 'create'])->name('coaches.create');
    Route::post('/coaches', [CoachController::class, 'store'])->name('coaches.store');
    Route::get('/coaches/{coach}', [CoachController::class, 'show'])->name('coaches.show');
    Route::get('/coaches/{coach}/edit', [CoachController::class, 'edit'])->name('coaches.edit');
    Route::put('/coaches/{coach}', [CoachController::class, 'update'])->name('coaches.update');
    Route::patch('/coaches/{coach}', [CoachController::class, 'update']);
    Route::delete('/coaches/{coach}', [CoachController::class, 'destroy'])->name('coaches.destroy');

    // Match Routes
    Route::get('/matches', [GameMatchController::class, 'index'])->name('matches.index');
    Route::get('/matches/create', [GameMatchController::class, 'create'])->name('matches.create');
    Route::post('/matches', [GameMatchController::class, 'store'])->name('matches.store');
    Route::get('/matches/{match}', [GameMatchController::class, 'show'])->name('matches.show');
    Route::get('/matches/{match}/edit', [GameMatchController::class, 'edit'])->name('matches.edit');
    Route::put('/matches/{match}', [GameMatchController::class, 'update'])->name('matches.update');
    Route::patch('/matches/{match}', [GameMatchController::class, 'update']);
    Route::delete('/matches/{match}', [GameMatchController::class, 'destroy'])->name('matches.destroy');
});

// Admin Routes - Can view, create, edit but NOT delete
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Player Routes (Admin - No Delete)
    Route::get('/admin/players', [PlayerController::class, 'adminIndex'])->name('admin.players.index');
    Route::get('/admin/players/create', [PlayerController::class, 'adminCreate'])->name('admin.players.create');
    Route::post('/admin/players', [PlayerController::class, 'adminStore'])->name('admin.players.store');
    Route::get('/admin/players/{player}', [PlayerController::class, 'adminShow'])->name('admin.players.show');
    Route::get('/admin/players/{player}/edit', [PlayerController::class, 'adminEdit'])->name('admin.players.edit');
    Route::put('/admin/players/{player}', [PlayerController::class, 'adminUpdate'])->name('admin.players.update');
    Route::patch('/admin/players/{player}', [PlayerController::class, 'adminUpdate']);

    // Coach Routes (Admin - No Delete)
    Route::get('/admin/coaches', [CoachController::class, 'adminIndex'])->name('admin.coaches.index');
    Route::get('/admin/coaches/create', [CoachController::class, 'adminCreate'])->name('admin.coaches.create');
    Route::post('/admin/coaches', [CoachController::class, 'adminStore'])->name('admin.coaches.store');
    Route::get('/admin/coaches/{coach}', [CoachController::class, 'adminShow'])->name('admin.coaches.show');
    Route::get('/admin/coaches/{coach}/edit', [CoachController::class, 'adminEdit'])->name('admin.coaches.edit');
    Route::put('/admin/coaches/{coach}', [CoachController::class, 'adminUpdate'])->name('admin.coaches.update');
    Route::patch('/admin/coaches/{coach}', [CoachController::class, 'adminUpdate']);

    // Match Routes (Admin - No Delete)
    Route::get('/admin/matches', [GameMatchController::class, 'adminIndex'])->name('admin.matches.index');
    Route::get('/admin/matches/create', [GameMatchController::class, 'adminCreate'])->name('admin.matches.create');
    Route::post('/admin/matches', [GameMatchController::class, 'adminStore'])->name('admin.matches.store');
    Route::get('/admin/matches/{match}', [GameMatchController::class, 'adminShow'])->name('admin.matches.show');
    Route::get('/admin/matches/{match}/edit', [GameMatchController::class, 'adminEdit'])->name('admin.matches.edit');
    Route::put('/admin/matches/{match}', [GameMatchController::class, 'adminUpdate'])->name('admin.matches.update');
    Route::patch('/admin/matches/{match}', [GameMatchController::class, 'adminUpdate']);
});

// User Routes - Read-only (View only)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])
        ->name('user.dashboard');

    // Player Routes (User - Read Only)
    Route::get('/user/players', [PlayerController::class, 'userIndex'])->name('user.players.index');
    Route::get('/user/players/{player}', [PlayerController::class, 'userShow'])->name('user.players.show');

    // Coach Routes (User - Read Only)
    Route::get('/user/coaches', [CoachController::class, 'userIndex'])->name('user.coaches.index');
    Route::get('/user/coaches/{coach}', [CoachController::class, 'userShow'])->name('user.coaches.show');

    // Match Routes (User - Read Only)
    Route::get('/user/matches', [GameMatchController::class, 'userIndex'])->name('user.matches.index');
    Route::get('/user/matches/{match}', [GameMatchController::class, 'userShow'])->name('user.matches.show');
});