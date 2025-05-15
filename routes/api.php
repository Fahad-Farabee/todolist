<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('tasks', [TaskController::class, 'show_tasks']);
Route::post('add-task', [TaskController::class, 'add_task']);
Route::put('task-update/{id}', [TaskController::class, 'update_task']);
Route::delete('task-delete/{id}', [TaskController::class, 'delete_task']);
