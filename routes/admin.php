<?php

use App\Http\Controllers\Admin\UserController;

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => 'admin',
    'middleware' => ['auth']
],function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
});

Route::get('edit-account-info', [UserController::class, 'accountInfo'])->name('admin.account.info');
Route::post('edit-account-info', [UserController::class, 'accountInfoStore'])->name('admin.account.info.store');
Route::post('change-password', [UserController::class, 'changePasswordStore'])->name('admin.account.password.store');
