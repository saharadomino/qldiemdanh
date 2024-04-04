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

Route::get('/manage-subject', [App\Http\Controllers\SubjectController::class,'manage_subject']);
Route::get('/add-subject', [App\Http\Controllers\SubjectController::class,'add_subject']);
Route::post('/save-subject', [App\Http\Controllers\SubjectController::class, 'save_subject']);
Route::get('/edit-subject/{orderId}', [App\Http\Controllers\SubjectController::class,'edit_subject']);
Route::post('/update-subject/{subject_id}', [App\Http\Controllers\SubjectController::class, 'update_subject']);

Route::get('/manage-attendance/{orderId}', [App\Http\Controllers\AttendanceController::class,'manage_attendance']);
Route::get('/present-attendance/{orderId}', [App\Http\Controllers\AttendanceController::class, 'present_attendance']);
Route::get('/not-present-attendance/{orderId}', [App\Http\Controllers\AttendanceController::class, 'not_present_attendance']);
Route::get('/add-student/{stuId}', [App\Http\Controllers\AttendanceController::class,'add_student']);
Route::post('/save-student', [App\Http\Controllers\AttendanceController::class, 'save_student']);