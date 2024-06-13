<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;


Route::get('/', [PostController::class, 'index'])->name('index');

Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);
Route::resource('faq-categories', FaqCategoryController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('like/{post_id}', [LikeController::class, 'like'])->name('like');

Route::get('/user/{name}', [UserController::class, 'profile'])->name('profile');
Route::put('/user/{name}', [UserController::class, 'updateBio'])->name('updateBio');
Route::get('/user/{name}/edit', [UserController::class, 'edit'])->name('edit');

Route::get('/admin', [UserController::class, 'admin'])->name('admin');
Route::post('/user/{id}/promote', [UserController::class, 'promote'])->name('promote');
Route::put('/user/{id}', [UserController::class, 'update'])->name('update');
/*Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', [UserController::class, 'index'])->name('admin');
});*/

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/admin', [ContactController::class, 'admin'])->name('contact.admin');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
Route::get('/faq/{id}/edit', [FaqController::class, 'edit'])->name('faq.edit');
Route::put('/faq/{id}', [FaqController::class, 'update'])->name('faq.update');
Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');
Route::get('/faq/manage', [FaqController::class, 'manage'])->name('faq.manage');


Route::get('/faq-categories', [FaqCategoryController::class, 'index'])->name('faq-categories.index');
Route::get('/faq-categories/create', [FaqCategoryController::class, 'create'])->name('faq-categories.create');
Route::post('/faq-categories', [FaqCategoryController::class, 'store'])->name('faq-categories.store');
Route::get('/faq-categories/{id}/edit', [FaqCategoryController::class, 'edit'])->name('faq-categories.edit');
Route::put('/faq-categories/{id}', [FaqCategoryController::class, 'update'])->name('faq-categories.update');
Route::delete('/faq-categories/{id}', [FaqCategoryController::class, 'destroy'])->name('faq-categories.destroy');

Route::get('/about', [AboutController::class, 'index'])->name('about.index');