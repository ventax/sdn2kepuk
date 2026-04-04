<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route dummy agar error route [login] not defined hilang
Route::get('login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Route login admin
Route::get('admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.submit');

// Route logout admin
Route::post('admin/logout', App\Http\Controllers\Admin\LogoutController::class)->name('admin.logout');

// Route untuk halaman admin (hanya untuk user yang sudah login)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class, [
        'as' => 'admin'
    ]);
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
});
