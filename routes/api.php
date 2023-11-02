<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Models\Department;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', [AuthController::class ,'login' ]);


Route::middleware('auth:sanctum')->group(function () {
        Route::controller(UserController::class)->group(function(){
            Route::get('emp/all', 'index');
            Route::post('emp/store', 'store');
            Route::post('emp/update', 'update');
            Route::post('emp/destroy', 'destroy');

        });

        Route::controller(DepartmentController::class)->group(function(){
            Route::get('department/all', 'index');
            Route::post('department/store', 'store');
            Route::post('department/update', 'update');
            Route::post('department/destroy', 'destroy');

        });

        Route::controller(TaskController::class)->group(function(){
            Route::get('task/all', 'index');
            Route::post('task/store', 'store');
            Route::post('task/update', 'update');
            Route::post('task/update-status', 'updateStatus');

        });


    });
    


    

