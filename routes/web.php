<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dataController;


Route::get('/', [dataController::class, 'loginPage']);
Route::get('/dashboard', [dataController::class, 'dashboard'])->name('dashboard');
Route::get('/get-tasks', [dataController::class, 'getTaskList'])->name('get-tasks');

Route::post('/login', [dataController::class, 'login'])->name('login');
Route::post('/register', [dataController::class, 'register'])->name('register');
Route::post('/add-task', [dataController::class, 'addTask'])->name('add-task');
Route::post('/update-task/{taskId}', [dataController::class, 'updateTask'])->name('update-task');
Route::post('/delete-task/{taskId}', [dataController::class, 'deleteTask'])->name('delete-task');

Route::get('/registration', function () {
    return view('register');
});
