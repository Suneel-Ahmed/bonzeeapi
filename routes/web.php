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
    
    // Payment Methods : 
   



    // Missions
    Route::get('/missions', [AdminController::class, 'missions'])->name('missions');
    Route::get('/missions/create', [AdminController::class, 'createMissions'])->name('create_mission');
    Route::post('/missions', [AdminController::class, 'storeMissions'])->name('store_mission');
    Route::get('/missions/update/{id}', [AdminController::class, 'viewUpdateMission'])->name('view_update_mission');
    Route::post('/missions/update/{id}', [AdminController::class, 'updateMission'])->name('update_mission');
    Route::delete('/missions/delete/{id}', [AdminController::class, 'deleteMission'])->name('delete_mission');
    
    // Tasks
    Route::get('/tasks', [AdminController::class, 'tasks'])->name('tasks');
    Route::get('/tasks/create', [AdminController::class, 'createTask'])->name('create_task');
    Route::post('/tasks', [AdminController::class, 'storeTask'])->name('store_task');
    Route::get('/tasks/update/{id}', [AdminController::class, 'updateViewTask'])->name('update_view_task');
    Route::post('/tasks/update/{id}', [AdminController::class, 'updateTask'])->name('update_task');
    Route::delete('/tasks/delete/{id}', [AdminController::class, 'deleteTask'])->name('delete_task');
    


    // Daily Tasks
    Route::get('/daily-tasks', [AdminController::class, 'dailyTasks'])->name('daily_tasks');
    Route::get('/daily-tasks/create', [AdminController::class, 'createDailyTask'])->name('create_daily_task');
    Route::get('/daily-tasks/update/{id}', [AdminController::class, 'viewUpdateDailyTask'])->name('view_update_daily_task');
    Route::post('/daily-tasks/update/{id}', [AdminController::class, 'updateDailyTask'])->name('update_daily_task');
    Route::delete('/daily-tasks/delete/{id}', [AdminController::class, 'deleteDailyTasks'])->name('delete_daily_tasks');
    Route::post('/daily-tasks', [AdminController::class, 'storeDailyTask'])->name('store_daily_task');
    
    
    // Offical Partners
    Route::get('/offical_partners', [AdminController::class, 'officalPartners'])->name('offical_partners');
    Route::get('/offical_partners/create', [AdminController::class, 'createViewOfficalPartners'])->name('create_offical');
    Route::post('/offical_partners/create', [AdminController::class, 'storeOfficalPartner'])->name('store_offical');
    Route::get('/offical_partners/update/{id}', [AdminController::class, 'updateViewOfficalPartner'])->name('update_view_offical');
    Route::post('/offical_partners/update/{id}', [AdminController::class, 'updateOfficalPartner'])->name('update_offical');
    Route::delete('/offical_partners/delete/{id}', [AdminController::class, 'deleteOfficalPartner'])->name('delete_offical');
});

require __DIR__.'/auth.php';
