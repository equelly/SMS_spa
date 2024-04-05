<?php

use App\Http\Controllers\GetController;
use App\Http\Controllers\User\Order\CreateController;
use App\Http\Controllers\User\Order\DeleteController;
use App\Http\Controllers\User\Order\IndexController;
use App\Http\Controllers\User\Order\PersonalController;
use App\Http\Controllers\User\Order\SetController;
use App\Http\Controllers\User\Order\StoreController;
use App\Http\Controllers\User\Order\UpdateController;
use App\Http\Controllers\User\Order\UserNameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>'auth:sanctum'], function(){
   
    Route::get('/get', [GetController::class, '__invoke']);
    Route::get('/orders', [IndexController::class, '__invoke']);
    Route::get('/username', [UserNameController::class, '__invoke']);
    Route::get('/personal', [PersonalController::class, '__invoke']);
    Route::get('/create', [CreateController::class, '__invoke']);
    Route::get('/sets', [SetController::class, '__invoke']);
    //Route::get('/categories', [CategoryController::class, '__invoke']);
    Route::post('/store', [StoreController::class, '__invoke']);
    Route::patch('/personal/{order}', [UpdateController::class, '__invoke']);
    Route::delete('/personal/{order}', [DeleteController::class, '__invoke']);


});

