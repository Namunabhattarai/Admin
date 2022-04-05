<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/admin')->group(function (){
Route::match(['get','post'],'/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'adminLogin'])->name('adminLogin');
Route::group(['middleware'=>['admin']],function (){

Route::get('/dashboard', [App\Http\Controllers\Admin\AdminLoginController::class, 'dashboard'])->name('dashboard');
Route::