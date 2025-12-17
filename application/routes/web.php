<?php

use App\Livewire\Admin\Category;
use App\Livewire\User\Cart;
use App\Livewire\User\Home;
use App\Livewire\Admin\User;
use Laravel\Fortify\Features;
use App\Livewire\User\Product;
use App\Livewire\Admin\Setting as SettingAdmin;
use App\Livewire\Admin\Product as ProductAdmin;
use App\Livewire\Admin\Order as OrderAdmin;
use App\Livewire\Admin\Dashboard as DashboardAdmin;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Livewire\Petani\Dashboard as DashboardPetani;
use App\Livewire\Petani\Product as ProductPetani;
use App\Livewire\Petani\Order as OrderPetani;
use App\Livewire\Petani\Sale as SalePetani;
use App\Livewire\Petani\Profile as ProfilePetani;
use App\Livewire\Petani\Setting as SettingPetani;
use App\Models\Order;

// Public Routes
Route::get('/', Home::class)->name('home');

// Placeholder routes (to be implemented)
Route::get('/products', Product::class)->name('products');
Route::view('/about', 'welcome')->name('about');
Route::view('/contact', 'welcome')->name('contact');

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/cart', Cart::class)->name('cart');
    Route::view('/orders', 'welcome')->name('orders');
    Route::view('/profile', 'welcome')->name('profile');
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



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
