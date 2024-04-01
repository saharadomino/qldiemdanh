<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/admin_login');
});
Route::get('/admin', [App\Http\Controllers\AdminController::class,'index']);
Route::get('/dashboard', [App\Http\Controllers\AdminController::class,'show_dashboard']);
Route::match(['get', 'post'], '/admin-dashboard', [App\Http\Controllers\AdminController::class, 'dashboard']);
Route::get('/logout', [App\Http\Controllers\AdminController::class,'logout']);

Route::get('/manage-order', [App\Http\Controllers\ClassController::class,'manage_order']);
Route::get('/view-order/{orderId}', [App\Http\Controllers\ClassController::class,'view_order']);
Route::get('/delete-order/{orderId}', [App\Http\Controllers\ClassController::class,'delete_order']);
Route::get('/add-class', [App\Http\Controllers\ClassController::class,'add_class']);
Route::post('/save-class', [App\Http\Controllers\ClassController::class, 'save_class']);

Route::get('/manage-schedule', [App\Http\Controllers\ClassController::class,'manage_schedule']);
Route::get('/edit-schedule/{orderId}', [App\Http\Controllers\ClassController::class,'edit_schedule']);
Route::post('/update-schedule/{product_id}', [App\Http\Controllers\ClassController::class, 'update_schedule']);
Route::get('/delete-schedule/{orderId}', [App\Http\Controllers\ClassController::class,'delete_schedule']);

