<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
Route::controller(TaskController::class)->group(function(){
    Route::post('/task','store')->name('task.store');
    Route::put('/task/{task}','update')->name('task.update');
    Route::put('/task/complete/{task}','updateStatus')->name('task.updateStatus');
    Route::delete('/task/{id}','destroy')->name('task.destroy');
    Route::get('/task','index')->name('task.index');
    Route::get('/task/{id}','show')->name('task.show');
    Route::get('/task/search/{desc}','searchTask')->name('task.searchTask');
    
});