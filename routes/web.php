<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailcheckcodeController;
use App\Http\Controllers\EmailverificationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


/*
Login rutlari
*/


Route::get("/", [LoginController::class, "login"])->name("login");
Route::post("/authlogin", [LoginController::class, "authlogin"])->name("authlogin");

/*
Register rutlari
*/

Route::get("/register", [RegisterController::class, "register"])->name("register");
Route::post("/authregister", [RegisterController::class, "authregister"])->name("authregister");

/*
Email rutlari
*/

Route::get("email", [EmailverificationController::class, "email"])->name("email");
Route::post("authemail", [EmailverificationController::class, "authemail"])->name("authemail");
/*
Emailcheck
*/

Route::get("emailcheckcode", [EmailcheckcodeController::class, "showVerifyForm"])->name("emailcheckcode");
Route::post("authemailcheckcode", [EmailcheckcodeController::class, "verifyCode"])->name("authemailcheckcode");


//dashboard rutlari

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    // Task create
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/admin/history', [AdminController::class, 'history'])->name('admin.history');
});

Route::get('super-admin', [SuperAdminController::class, 'super'])->name('super_admin.super');
Route::post('super-admin/{user}', [SuperAdminController::class, 'updaterole'])->name('super_admin.updaterole');

Route::patch('/tasks/{task}/status', [App\Http\Controllers\TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

Route::get('/notifications/read', [SuperAdminController::class, 'markAsRead'])->name('super_admin.markAsRead'); 