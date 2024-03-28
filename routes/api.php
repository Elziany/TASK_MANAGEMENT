<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthUserController;
use App\Http\Controllers\Api\ManagerTaskController;
use App\Http\Controllers\Api\UserTaskController;
use App\Http\Controllers\Api\TaskDependency;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
//Auth Routes
Route::group(['prefix' => 'auth'] , function(){
    Route::post('/user/regitser' , [AuthUserController::class , 'userRegister'])->name('userRegister');
    Route::post('/manager/regitser' , [AuthUserController::class , 'managerRegister'])->name('managerRegister');
    Route::post('/login' , [AuthUserController::class , 'login'])->name('login');
});

Route::group(['middleware' => 'auth:sanctum' ] , function(){

    //tasks routes
    Route::group([ 'prefix' => 'tasks'] , function(){
        //manager task Routes
        Route::group(['middleware' => 'auth.manager'] , function(){
            Route::get('/' , [ManagerTaskController::class , 'index']);
            Route::post('/store' , [ManagerTaskController::class , 'store']);
            Route::put('/update/{id}' , [ManagerTaskController::class , 'update']);
            Route::delete('/delete/{id}' , [ManagerTaskController::class , 'destroy']);
            Route::post('/assign/task' , [ManagerTaskController::class , 'assignTask']);
        });

        //user task Routes
        Route::get('/user/tasks' , [UserTaskController::class , 'getAllTasks']);
        Route::put('/update/status/{id}' , [UserTaskController::class , 'updateStatus']);    
    });


    //tasks dependencies routes
    Route::group(['middleware' => 'auth.manager','prefix' => 'dependecy'] , function(){
       
            Route::get('/getAllDependencies/{task_id}' , [TaskDependency::class , 'getAllDependencies']);
            Route::post('/addDependenicesTask' , [TaskDependency::class , 'addDependenicesTask']);   
    });


});
