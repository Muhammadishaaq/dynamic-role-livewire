<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Auth\LoginController;
use App\Livewire\Dashboard;
use App\Livewire\PermissionManager;
use App\Livewire\RoleManager;

/* login */
Route::get('/', [LoginController::class, 'loginForm'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
   
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard.index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/permissions', PermissionManager::class)->name('permissions.index');
    Route::get('/roles', RoleManager::class,'roleRender')->name('roles.index');
   

});


