<?php

use App\Http\Controllers\TaskListsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());
Route::middleware('auth:sanctum')->prefix('/task-lists')->group(function () {
    Route::put('/{id:uuid}', [TaskListsController::class, 'createTask']);
    Route::get('/', [TaskListsController::class, 'getAllTaskLists']);
    Route::get('/{id:uuid}', [TaskListsController::class, 'getTaskList']);
});
