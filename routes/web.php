<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\CompletedShoppingListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//--------------------
// User
//--------------------
// pre auth
Route::get('/', [AuthController::class, 'index'])->name('front.index');
Route::post('/login', [AuthController::class, 'login']);
// register
Route::prefix('/user')->group(function() {
    Route::get('/register', [UserController::class, 'index'])->name('front.user.index');
    Route::post('/register', [UserController::class, 'register'])->name('front.user.register.post');
});
// post auth
Route::middleware(['auth'])->group(function(){
    Route::prefix('/shopping_list')->group(function() {
        Route::get('/list', [ShoppingListController::class, 'list'])->name('front.list');
        Route::post('/register', [ShoppingListController::class, 'register']);
        Route::delete('/delete/{shopping_list_id}', [ShoppingListController::class, 'delete'])->whereNumber('shopping_list_id')->name('delete');
        Route::post('/complete/{shopping_list_id}', [ShoppingListController::class, 'complete'])->whereNumber('shopping_list_id')->name('complete');
    });
    // display completed shopping list
    Route::get('/completed_shopping_list/list', [CompletedShoppingListController::class, 'list']);
    // logout
    Route::get('/logout', [AuthController::class, 'logout']);
});
//--------------------
// Admin
//--------------------
Route::prefix('/admin')->group(function () {
    // pre auth
    Route::get('', [AdminAuthController::class, 'index'])->name('admin.index');
    Route::post('/login', [AdminAuthController::class, 'login']);
    // post auth
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/top', [AdminHomeController::class, 'top'])->name('admin.top');
        Route::get('/user/list', [AdminUserController::class, 'list'])->name('admin.user.list');
    });
    // logout
    Route::get('/logout', [AdminAuthController::class, 'logout']);
});