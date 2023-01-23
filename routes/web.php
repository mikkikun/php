<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;


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

Route::get('admin/post/index', [App\Http\Controllers\Admin\PostController::class, 'home'])->name('admin/post/index');

Route::group(['prefix' => 'admin'], function() {
    Route::get('post/create', [PostController::class, 'add'])->middleware('auth');
    Route::post('post/create', [PostController::class, 'create'])->middleware('auth');
    Route::get('post/index', [PostController::class, 'index'])->middleware('auth'); 
    Route::get('post/edit', [PostController::class, 'edit'])->middleware('auth'); 
    Route::post('post/edit', [PostController::class, 'update'])->middleware('auth');
    Route::post('post/index', [PostController::class, 'delete'])->middleware('auth');
});
