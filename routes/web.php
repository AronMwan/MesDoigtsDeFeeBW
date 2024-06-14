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
use App\Http\Controllers\TagController;
use App\Http\Controllers\AdminController;

Route::get('/', [PostController::class, 'index'])->name('index');

Route::resource('posts', PostController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('faq-categories', FaqCategoryController::class)->middleware('auth');
Route::resource('tags', TagController::class)->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
Route::get('like/{post_id}', [LikeController::class, 'like'])->name('like')->middleware('auth');




Route::get('/user/{name}', [UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::put('/user/{name}', [UserController::class, 'updateBio'])->name('updateBio')->middleware('auth');
Route::get('/user/{name}/edit', [UserController::class, 'edit'])->name('edit')->middleware('auth');
Route::get('/user/{name}/edit-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showChangePasswordForm'])->name('change-password')->middleware('auth');

Route::get('/users/admin', [UserController::class, 'admin'])->name('users.admin')->middleware(['auth', 'admin']);
Route::post('/user/{id}/promote', [UserController::class, 'promote'])->name('promote')->middleware(['auth', 'admin']);
Route::put('/user/{id}', [UserController::class, 'update'])->name('update')->middleware('auth');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/admin', [ContactController::class, 'admin'])->name('contact.admin')->middleware(['auth', 'admin']);

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create')->middleware('auth');
Route::post('/faq', [FaqController::class, 'store'])->name('faq.store')->middleware('auth');
Route::get('/faq/{id}/edit', [FaqController::class, 'edit'])->name('faq.edit')->middleware('auth');
Route::put('/faq/{id}', [FaqController::class, 'update'])->name('faq.update')->middleware('auth');
Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy')->middleware('auth');
Route::get('/faq/manage', [FaqController::class, 'manage'])->name('faq.manage')->middleware('auth');

Route::get('/faq-categories', [FaqCategoryController::class, 'index'])->name('faq-categories.index');
Route::get('/faq-categories/create', [FaqCategoryController::class, 'create'])->name('faq-categories.create')->middleware('auth');
Route::post('/faq-categories', [FaqCategoryController::class, 'store'])->name('faq-categories.store')->middleware('auth');
Route::get('/faq-categories/{id}/edit', [FaqCategoryController::class, 'edit'])->name('faq-categories.edit')->middleware('auth');
Route::put('/faq-categories/{id}', [FaqCategoryController::class, 'update'])->name('faq-categories.update')->middleware('auth');
Route::delete('/faq-categories/{id}', [FaqCategoryController::class, 'destroy'])->name('faq-categories.destroy')->middleware('auth');

Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create')->middleware('auth');
Route::post('/tags', [TagController::class, 'store'])->name('tags.store')->middleware('auth');
Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit')->middleware('auth');
Route::put('/tags/{id}', [TagController::class, 'update'])->name('tags.update')->middleware('auth');
Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy')->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth', 'admin']);

