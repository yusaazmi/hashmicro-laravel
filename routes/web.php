<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('product',ProductController::class);
    Route::resource('user',UserController::class);
});
Route::get('index', [DashboardController::class, 'index'])->name('index');

Route::get('input-feature',[DashboardController::class,'inputFeature'])->name('input-feature');
Route::post('input-feature',[DashboardController::class,'storeInputFeature'])->name('store-input-feature');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::post('logout', [AuthController::class, 'logout'])->name('logout');