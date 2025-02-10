<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Category
Route::get('/admin/category/list', [App\Http\Controllers\CategoryController::class, 'listCategory'])->Middleware('auth');
Route::post('/admin/category/add', [App\Http\Controllers\CategoryController::class, 'createCategory'])->Middleware('auth');
Route::get('/admin/category/del/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory'])->middleware('auth');
Route::get('/admin/category/upd/{id}', [App\Http\Controllers\CategoryController::class, 'updCategory'])->middleware('auth');
Route::post('/admin/category/upd/{id}', [App\Http\Controllers\CategoryController::class, 'updateCategory'])->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
