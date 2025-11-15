<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/change-password', [ProfileController::class, 'profilePassword'])->name('profile.password');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('projects', ProjectController::class);
    Route::post('/project/upload-file', [ProjectController::class, 'uploadFile'])->name('projects.uploadFile');
    Route::get('/projects/files/{id}', [ProjectController::class, 'projectFiles'])->name('projects.files');
    Route::delete('/projects/files/{id}', [ProjectController::class, 'deleteFile'])->name('projects.files.delete');
    Route::post('/project/{id}/admin-upload-file', [ProjectController::class, 'adminUploadFile'])->name('admin.project-files');
    Route::put('/project/{project}/status', [ProjectController::class, 'updateStatus'])->name('projects.updateStatus');
    Route::post('/notifications/mark-all-read', [ProfileController::class, 'markAllRead'])->name('notifications.markAllRead');

});

require __DIR__.'/auth.php';
