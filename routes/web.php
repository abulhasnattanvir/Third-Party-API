<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ProductController::class,'products'])->name('product.view');
Route::get('/create',[ProductController::class,'create'])->name('product.create');
Route::post('/store',[ProductController::class,'store'])->name('product.store');
Route::get('/edit',[ProductController::class,'edit'])->name('product.edit');
Route::post('/update/{id}',[ProductController::class,'update'])->name('product.update');
Route::delete('/delete/{id}',[ProductController::class,'delete'])->name('product.delete');