<?php

use App\Livewire\User\Cart;
use App\Livewire\User\Home;
use App\Livewire\Admin\User;
use App\Livewire\User\Order;
use App\Livewire\User\Product;
use App\Livewire\User\Product\Detail as DetailProduct;
use App\Livewire\User\Profile;
use App\Livewire\Admin\Category;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Order as OrderAdmin;
use App\Livewire\Petani\Sale as SalePetani;
use App\Livewire\Petani\Order as OrderPetani;
use App\Livewire\Admin\Product as ProductAdmin;
use App\Livewire\Admin\Setting as SettingAdmin;
use App\Livewire\Petani\Product as ProductPetani;
use App\Livewire\Petani\Profile as ProfilePetani;
use App\Livewire\Petani\Setting as SettingPetani;
use App\Livewire\Admin\Dashboard as DashboardAdmin;
use App\Livewire\Petani\Dashboard as DashboardPetani;
use App\Livewire\User\Checkout;

// Public Routes
Route::get('/', Home::class)->name('home');

// Placeholder routes (to be implemented)

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/orders', Order::class)->name('orders');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/products', Product::class)->name('products');
    Route::get('/products/{id}', DetailProduct::class)->name('product.detail');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardAdmin::class)->name('dashboard');
    Route::get('/users', User::class)->name('users');
    Route::get('/category', Category::class)->name('categories');
    Route::get('/products', ProductAdmin::class)->name('products');
    Route::get('/order', OrderAdmin::class)->name('orders');
    Route::get('/settings', SettingAdmin::class)->name('settings');
});

// Petani Routes
Route::middleware(['auth', 'role:petani'])->prefix('petani')->name('petani.')->group(function () {
    Route::get('/dashboard', DashboardPetani::class)->name('dashboard');
    Route::get('products', ProductPetani::class)->name('products');
    Route::get('orders', OrderPetani::class)->name('orders');
    Route::get('sales', SalePetani::class)->name('sales');
    Route::get('profile', ProfilePetani::class)->name('profile');
    Route::get('settings', SettingPetani::class)->name('settings');
});
