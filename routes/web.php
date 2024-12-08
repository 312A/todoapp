<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;
use Illuminate\Support\Facades\Route;


Route::get("login", [AuthManager::class, 'login'])
    ->name("login");


Route::post("login", [AuthManager::class, 'loginPost'])
    ->name("login.post");

Route::get("logout", [AuthManager::class, 'logout'])
    ->name(name: "logout");

Route::get("register", [AuthManager::class, 'register'])->name("register");

Route::post("register", [AuthManager::class, 'registerPost'])->name("register.post");


Route::middleware("auth")->group(
    function () {
        // Route::get('/', function () {
        //     return view('welcome');
        // })->name("home");
        Route::get('/', [TaskManager::class, "listTask"])
            ->name("home");

        Route::get("tasks/list", [TaskManager::class, "addTask"])
            ->name("task.list");


        Route::get("tasks/add", [TaskManager::class, "addTask"])
            ->name("task.add");

        Route::post("tasks/add", [TaskManager::class, "addTaskPost"])
            ->name("task.add.post");

        Route::get("tasks/status/{id}", [TaskManager::class, "updateTaskStatus"])
            ->name("task.status.update");
        Route::get("tasks/edit/{id}",[TaskManager::class,"editTask"])
            ->name("task.edit");
        Route::post("task/edit/{id}",[TaskManager::class,"updateTask"])
            ->name("task.update");
        Route::get("tasks/delete/{id}", [TaskManager::class, "deleteTask"])
            ->name("task.delete");
    }
);
