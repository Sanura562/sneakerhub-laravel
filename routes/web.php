<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    ProductsController,
    AdminDashboardController,
    Auth\adminDashController,
    UserProfileController,
    HomeController
};
use App\Http\Livewire\{
    Storepage as LivewireStorepage,
    ProductView as LivewireProductView,
    AdminDashboard,
    CartPage,
    ViewProducts
};

// Home page
Route::get('/', [HomeController::class, 'index'])->name('index');

// Jetstream dashboard
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Product CRUD
Route::get('/addProducts', fn() => view('addProducts'))->name('addProducts');
Route::post('/addProducts', [ProductsController::class, 'store'])->name('products.store');
Route::get('/editProduct/{id}', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/EditProducts/{id}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

// Admin dashboard
Route::get('/admin-dashboard', AdminDashboard::class)->name('admin.dashboard');

// Product views
Route::get('/store', LivewireStorepage::class)->name('store');
Route::get('/storepage', [ProductsController::class, 'index'])->name('products.index');
Route::get('/product/{id}', LivewireProductView::class)->name('product.view');

// Cart
Route::get('/cart', CartPage::class)->name('cart');

// Admin product list
Route::get('/viewProducts', ViewProducts::class)->name('product.viewall');


use App\Http\Livewire\CheckoutPage;

Route::get('/checkout/{id}', CheckoutPage::class)->name('checkout');

require __DIR__.'/auth.php';;