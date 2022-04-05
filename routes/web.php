<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/admin')->group(function (){
Route::match(['get','post'],'/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'adminLogin'])->name('adminLogin');
Route::group(['middleware'=>['admin']],function (){

Route::get('/dashboard', [App\Http\Controllers\Admin\AdminLoginController::class, 'dashboard'])->name('dashboard');
//category
Route::get('/add-category', [App\Http\Controllers\Admin\CategoryController::class, 'addCategory'])->name('addCategory');
Route::get('/category/index', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [App\Http\Controllers\Admin\CategoryController::class, 'storeCategory'])->name('storeCategory');
Route::get('/category/table', [App\Http\Controllers\Admin\CategoryController::class, 'dataTable'])->name('tableCategory');
Route::get('/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'editCategory'])->name('editCategory');
Route::get('/category/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'updateCategory'])->name('updateCategory');
Route::get('/category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteCategory'])->name('deleteCategory');
});
});