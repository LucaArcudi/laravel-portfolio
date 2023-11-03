<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Guest\ProjectController as GuestProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [GuestProjectController::class, 'index']);

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/skills', AdminSkillController::class);
    Route::resource('/categories', CategoryController::class);
    Route::patch('/projects/{project}/clear-skills', [AdminProjectController::class, 'clearSkills'])->name('projects.clear-skills');
    Route::patch('/projects/{project}/clear-category', [AdminProjectController::class, 'clearCategory'])->name('projects.clear-category');
    Route::patch('/projects/{project}/visibility-toggle', [AdminProjectController::class, 'visibilityToggle'])->name('projects.visibility-toggle');
    Route::get('/projects/trash', [AdminProjectController::class, 'trash'])->name('projects.trash');
    Route::post('/projects/{project}/restore', [AdminProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('/projects/{project}/force-delete', [AdminProjectController::class, 'forceDelete'])->name('projects.force-delete');
    Route::post('/projects/restore-all', [AdminProjectController::class, 'restoreAll'])->name('projects.restore-all');
    Route::resource('/projects', AdminProjectController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
