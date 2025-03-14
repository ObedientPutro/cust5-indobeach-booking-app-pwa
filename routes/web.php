<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Owner\AmenityController;
use App\Http\Controllers\Owner\BookingHistoryController;
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Guest and costumer access
Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Customer and owner access
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Customer access
Route::middleware(['auth', 'customer', 'verified'])->group(function () {

});

// Owner access
Route::middleware(['auth', 'owner'])->group(function () {
    Route::resource('/admin/dashboard', DashboardController::class)->names([
        'index'   => 'admin.dashboard',
        'create'  => 'admin.dashboard.new',
        'store'   => 'admin.dashboard.save',
        'show'    => 'admin.dashboard.view',
        'edit'    => 'admin.dashboard.modify',
        'update'  => 'admin.dashboard.update',
        'destroy' => 'admin.dashboard.delete',
    ]);

    Route::resource('/admin/post', PostController::class)->names([
        'index'   => 'admin.post.index',
        'create'  => 'admin.post.new',
        'store'   => 'admin.post.save',
        'show'    => 'admin.post.view',
        'edit'    => 'admin.post.modify',
        'update'  => 'admin.post.update',
        'destroy' => 'admin.post.delete',
    ]);

    Route::resource('/admin/category', CategoryController::class)->names([
        'index'   => 'admin.category.index',
        'create'  => 'admin.category.new',
        'store'   => 'admin.category.save',
        'show'    => 'admin.category.view',
        'edit'    => 'admin.category.modify',
        'update'  => 'admin.category.update',
        'destroy' => 'admin.category.delete',
    ]);

    Route::resource('/admin/amenity', AmenityController::class)->names([
        'index'   => 'admin.amenity.index',
        'create'  => 'admin.amenity.new',
        'store'   => 'admin.amenity.save',
        'show'    => 'admin.amenity.view',
        'edit'    => 'admin.amenity.modify',
        'update'  => 'admin.amenity.update',
        'destroy' => 'admin.amenity.delete',
    ]);

    Route::resource('/admin/booking-history', BookingHistoryController::class)->names([
        'index'   => 'admin.booking-history.index',
        'create'  => 'admin.booking-history.new',
        'store'   => 'admin.booking-history.save',
        'show'    => 'admin.booking-history.view',
        'edit'    => 'admin.booking-history.modify',
        'update'  => 'admin.booking-history.update',
        'destroy' => 'admin.booking-history.delete',
    ]);
});
