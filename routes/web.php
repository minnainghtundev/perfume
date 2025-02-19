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

// Item

Route::get('/admin/item/list', [App\Http\Controllers\ItemController::class, 'listItem'])->middleware('auth');
Route::post('/admin/item/add', [App\Http\Controllers\ItemController::class, 'createItem'])->middleware('auth');
Route::get('/admin/item/del/{id}', [App\Http\Controllers\ItemController::class, 'deleteItem'])->middleware('auth');
Route::get('/admin/item/upd/{id}', [App\Http\Controllers\ItemController::class, 'updItem'])->middleware('auth');
Route::post('/admin/item/upd/{id}', [App\Http\Controllers\ItemController::class, 'updateItem'])->middleware('auth');


Route::get('/category/{id}/item/view', [App\Http\Controllers\ItemController::class, 'categoryView']);
//Category View

//Detail View
Route::get('/item/{id}/detail', [App\Http\Controllers\ItemController::class, 'detailView']);
//Detail View

//addToCartQty
Route::get('/item/addToCartQty/{id}', [App\Http\Controllers\ItemController::class, 'getAddToCartQty']);
//addToCartQty

//shoppingCart
Route::get('/item/shoppingCart', [App\Http\Controllers\ItemController::class, 'getCart']);
//shoppingCart

//Minus (-) shoppingCart
Route::get('/item/subToCart/{id}', [App\Http\Controllers\ItemController::class, 'getSubToCart']);
//Minus (-) shoppingCart

//Plus (+) shoppingCart
Route::get('/item/addToCart/{id}', [App\Http\Controllers\ItemController::class, 'getAddToCart']);
//Plus (+) shoppingCart

//Remove shoppingCart
Route::get('/item/removeFromCart/{id}', [App\Http\Controllers\ItemController::class, 'getRemoveFromCart']);
//Remove shoppingCart

//Clear shoppingCart
Route::get('/item/clearCart', [App\Http\Controllers\ItemController::class, 'getClearCart']);
//Clear shoppingCart

//Order
Route::get('/order', [App\Http\Controllers\ItemController::class, 'getOrder'])->middleware('auth');
//Order

//Payment
Route::get('/payment', [App\Http\Controllers\ItemController::class, 'getPayment']);
Route::post('/payment', [App\Http\Controllers\ItemController::class, 'createPayment']);
//Payment


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
