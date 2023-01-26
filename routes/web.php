<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;



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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('post/index', [App\Http\Controllers\Admin\PostController::class, 'home'])->name('admin/post/index');

Route::group(['prefix' => 'admin'], function() {
    Route::get('post/create', [PostController::class, 'add'])->middleware('auth');
    Route::post('post/create', [PostController::class, 'create'])->middleware('auth');
    Route::get('post/index', [PostController::class, 'index'])->middleware('auth'); 
    Route::get('post/edit', [PostController::class, 'edit'])->middleware('auth'); 
    Route::post('post/edit', [PostController::class, 'update'])->middleware('auth');
    Route::post('post/index', [PostController::class, 'delete'])->middleware('auth');
    Route::get('post/index', [PostController::class, 'index'])->middleware('auth')->name('top'); 
    
    
    Route::get('profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile-edit'); 
    Route::post('profile/edit', [ProfileController::class, 'update'])->middleware('auth');
    Route::get('profile/delte', [ProfileController::class, 'deletepage'])->middleware('auth')->name('profile-delete-page');
    Route::post('profile/delte', [ProfileController::class, 'delete'])->middleware('auth');
    Route::get('profile/mypage', [ProfileController::class, 'index'])->middleware('auth')->name('mypage'); 
    Route::get('post/mypage', [ProfileController::class, 'indexpage'])->middleware('auth'); 
    
});
