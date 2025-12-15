<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\User\Cart;
use App\Livewire\User\Home;
use App\Livewire\User\Product;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

// Public Routes
Route::get('/', Home::class)->name('home');

// Placeholder routes (to be implemented)
Route::get('/products', Product::class)->name('products');
Route::view('/about', 'welcome')->name('about');
Route::view('/contact', 'welcome')->name('contact');

// Auth Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', Cart::class)->name('cart');
    Route::view('/orders', 'welcome')->name('orders');
    Route::view('/profile', 'welcome')->name('profile');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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
