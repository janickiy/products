<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AuthController,
    CategoryController,
    DashboardController,
    DataTableController,
    UsersController,
    ProductsController,
    StockInController,
    SalesController,
};

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

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::group(['prefix' => 'category'], function () {
    Route::get('', [CategoryController::class, 'index'])->name('admin.category.index')->middleware(['permission:admin|moderator']);
    Route::get('create', [CategoryController::class, 'create'])->name('admin.category.create')->middleware(['permission:admin|moderator']);
    Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store')->middleware(['permission:admin|moderator']);
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit')->where('id', '[0-9]+')->middleware(['permission:admin|moderator']);
    Route::put('update', [CategoryController::class, 'update'])->name('admin.category.update')->middleware(['permission:admin|moderator']);
    Route::post('destroy', [CategoryController::class, 'destroy'])->name('admin.category.destroy')->middleware(['permission:admin|moderator']);
});

Route::group(['prefix' => 'products'], function () {
    Route::get('', [ProductsController::class, 'index'])->name('admin.products.index')->middleware(['permission:admin|moderator']);
    Route::get('create', [ProductsController::class, 'create'])->name('admin.products.create')->middleware(['permission:admin|moderator']);
    Route::post('store', [ProductsController::class, 'store'])->name('admin.products.store')->middleware(['permission:admin|moderator']);
    Route::get('edit/{id}', [ProductsController::class, 'edit'])->name('admin.products.edit')->where('id', '[0-9]+')->middleware(['permission:admin|moderator']);
    Route::put('update', [ProductsController::class, 'update'])->name('admin.products.update')->middleware(['permission:admin|moderator']);
    Route::post('destroy', [ProductsController::class, 'destroy'])->name('admin.products.destroy')->middleware(['permission:admin|moderator']);
});

Route::group(['prefix' => 'stock-in'], function () {
    Route::get('', [StockInController::class, 'index'])->name('admin.stock_in.index')->middleware(['permission:admin|moderator']);
    Route::get('create', [StockInController::class, 'create'])->name('admin.stock_in.create')->middleware(['permission:admin|moderator']);
    Route::post('store', [StockInController::class, 'store'])->name('admin.stock_in.store')->middleware(['permission:admin|moderator']);
});

Route::group(['prefix' => 'sales'], function () {
    Route::get('create', [SalesController::class, 'create'])->name('admin.sales.create')->middleware(['permission:admin|moderator']);
    Route::post('store', [SalesController::class, 'store'])->name('admin.sales.store')->middleware(['permission:admin|moderator']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('store', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit')->where('id', '[0-9]+');
    Route::put('update', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('destroy', [UsersController::class, 'destroy'])->name('admin.users.destroy')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'datatable'], function () {
    Route::any('category', [DataTableController::class, 'category'])->name('admin.datatable.category');
    Route::any('products', [DataTableController::class, 'products'])->name('admin.datatable.products');
    Route::any('users', [DataTableController::class, 'users'])->name('admin.datatable.users');
    Route::any('stock', [DataTableController::class, 'stock'])->name('admin.datatable.stock');
    //stock
});
