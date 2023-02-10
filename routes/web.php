<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\FavoritesController;
use App\Http\Controllers\Admin\ChatController;



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
Route::get('/guest-login', [ LoginController::class, 'guest'])->name('guestLogin');
Route::post('/guest-login', [ LoginController::class, 'guest'])->name('guestLogin');

Route::group(['prefix' => 'admin'], function() {
    Route::get('post/create', [PostController::class, 'add'])->middleware('auth')->name('create');
    Route::post('post/create', [PostController::class, 'create'])->middleware('auth');
    Route::get('post/index', [PostController::class, 'index'])->middleware('auth'); 
    Route::get('post/edit', [PostController::class, 'edit'])->middleware('auth'); 
    Route::post('post/edit', [PostController::class, 'update'])->middleware('auth');
    Route::post('post/index', [PostController::class, 'delete'])->middleware('auth');
    Route::get('post/index', [PostController::class, 'index'])->middleware('auth')->name('top'); 
    Route::get('post/follow_pose', [PostController::class, 'follow_pose'])->middleware('auth')->name('follow_pose');
    Route::post('favorites', [FavoritesController::class, 'store'])->middleware('auth')->name('favorites');
    Route::delete('favorites', [FavoritesController::class, 'destroy'])->middleware('auth')->name('unfavorites');
    Route::get('post/favorite', [FavoritesController::class, 'favorite_page'])->middleware('auth');
    

    Route::get('profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile-edit'); 
    Route::put('profile/edit', [ProfileController::class, 'update'])->middleware('auth');
    Route::get('profile/delte', [ProfileController::class, 'deletepage'])->middleware('auth')->name('profile-delete-page');
    Route::post('profile/delte', [ProfileController::class, 'delete'])->middleware('auth');
    Route::get('profile/userpage', [ProfileController::class, 'userpage'])->middleware('auth')->name('mypage'); 

    Route::post('profile/userpage', [ProfileController::class, 'follow'])->middleware('auth')->name('follow');
    Route::delete('profile/userpage',[ProfileController::class, 'unfollow'])->middleware('auth')->name('unfollow');
    Route::get('profile/follow', [ProfileController::class, 'follow_page'])->middleware('auth'); 
    Route::get('profile/follower', [ProfileController::class, 'follower_page'])->middleware('auth'); 


    Route::get('comment/index', [CommentsController::class, 'index'])->middleware('auth'); 
    Route::post('comment/index', [CommentsController::class, 'create'])->middleware('auth');
    Route::get('comment/edit', [CommentsController::class, 'edit'])->middleware('auth'); 
    Route::post('comment/edit', [CommentsController::class, 'update'])->middleware('auth');
    Route::delete('comment/index', [CommentsController::class, 'delete'])->middleware('auth');
    Route::post('favorites_comment', [FavoritesController::class, 'comment_store'])->middleware('auth')->name('favorites_comment');
    Route::delete('favorites_comment', [FavoritesController::class, 'comment_destroy'])->middleware('auth')->name('unfavorites_comment');


    Route::get('chat/chat', [ChatController::class, 'index'])->name('add');
    Route::post('chat', [ChatController::class, 'add'])->name('add');
});
