<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QueryCategoryController;
use App\Http\Controllers\Api\QueryController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;

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



Route::group(['middleware' => ['json.response', 'cors']], function () {

    //Public endpoints
    Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/forgotpasswordemail', [AuthController::class, 'forgotpasswordemail'])->name('forgotpasswordemail');

    //Private endpoints
    Route::middleware('auth:api')->group(function () {
        Route::post('/changepassword', [AuthController::class, 'changepassword'])->name('changepassword');
        Route::get('/me', [AuthController::class, 'viewprofile'])->name('me');
        Route::put('/profile', [AuthController::class, 'updateprofile'])->name('profile');
        Route::post('/add-user', [AuthController::class, 'addUser'])->name('adduser');
        Route::post('/add-user-email', [AuthController::class, 'addUserEmail'])->name('adduseremail');
        Route::post('/activate', [AuthController::class, 'activate'])->name('activate');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::resources([
            'query' => QueryController::class,
            'querycategory' => QueryCategoryController::class,
            'user' => UserController::class,
            'role' => RoleController::class,
        ]);
    });
});
