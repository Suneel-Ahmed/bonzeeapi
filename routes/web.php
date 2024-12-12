<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});
Route::get('/test-login', function () {
    $credentials = ['email' => 'sunailahmad7@gmail.com', 'password' => 'password'];
    if (Auth::attempt($credentials)) {
        return redirect('/dashboard');
    }
    return 'Login failed.';
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/missions', [AdminController::class, 'missions'])->name('missions');
    Route::get('/missions/create', [AdminController::class, 'createMissions'])->name('create_mission');
    Route::post('/missions', [AdminController::class, 'storeMissions'])->name('store_mission');
    Route::post('/missions/update/{id}', [AdminController::class, 'updateMission'])->name('update_mission');
    Route::delete('/missions/delete/{id}', [AdminController::class, 'deleteMission'])->name('delete_mission');
    
    Route::get('/tasks', [AdminController::class, 'tasks'])->name('tasks');
    Route::get('/tasks/create', [AdminController::class, 'createTask'])->name('create_task');
    Route::post('/tasks', [AdminController::class, 'storeTask'])->name('store_task');
    Route::get('/daily-tasks', [AdminController::class, 'dailyTasks'])->name('daily_tasks');
    Route::get('/daily-tasks/create', [AdminController::class, 'createDailyTask'])->name('create_daily_task');
    Route::post('/daily-tasks', [AdminController::class, 'storeDailyTask'])->name('store_daily_task');
});

require __DIR__.'/auth.php';
