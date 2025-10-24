<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Profile\ProfileController;
use App\Http\Controllers\Backend\Category\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// * Backend
Route::middleware('auth')->name('dashboard.')->prefix('/dashboard')->group(function() {
    
    // profile
    Route::get('/profile-update',[ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile-update',[ProfileController::class, 'Store'])->name('profile.store');
    Route::post('/password-update',[ProfileController::class,'passwordUpdate'])->name('password.update');
    Route::post('/image-update',[ProfileController::class,'imageUpdate'])->name('image.update');
    
    //Category
    Route::get('/category-index',[CategoryController::class,'categoryIndex'])->name('category.index');
    Route::post('/category-index',[CategoryController::class,'categoryStore'])->name('category.store');
    Route::get('/category-show',[CategoryController::class,'categoryShow'])->name('category.show');
    Route::get('/category-edit/{id}',[CategoryController::class,'categoryEdit'])->name('category.edit');
    Route::put('/category-update/{id}',[CategoryController::class,'categoryUpdate'])->name('category.update');
    Route::get('/category-delete/{id}',[CategoryController::class,'categoryDelete'])->name('category.delete');

    // Product
    Route::get('/product-index',[ProductController::class,'productIndex'])->name('product.index');
    Route::post('/product-store',[ProductController::class,'productStore'])->name('product.store');
    Route::get('/product-show',[ProductController::class,'productShow'])->name('product.show');
    Route::get('/product-edit/{id}',[ProductController::class,'productEdit'])->name('product.edit');
    Route::put('/product-update/{id}',[ProductController::class,'productUpdate'])->name('product.update');
    Route::get('/product-delete/{id}',[ProductController::class,'productDelete'])->name('product.delete');

    //image
    Route::get('/image-index',[ProductController::class,'productImageIndex'])->name('product.image.index');
    Route::post('/image-store',[ProductController::class,'productImageStore'])->name('product.image.store');
    Route::get('/image-show',[ProductController::class,'productImageShow'])->name('product.image.show');

});


// * Backend


require __DIR__.'/auth.php';
