<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Customer\CustomerBookingController;
use App\Http\Controllers\GazeboController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Owner\AmenityController;
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\OwnerBookingController;
use App\Http\Controllers\Owner\PostController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\PushSubscriptionController;
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
    Route::get('gazebo', [GazeboController::class, 'index'])->name('gazebo.index');
    Route::get('gazebo/{post}', [GazeboController::class, 'detail'])->name('gazebo.detail');

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Customer and owner access
Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::post('push-subscriptions', [PushSubscriptionController::class, 'store'])->name('push.store');
});

// Customer access
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('booking', [CustomerBookingController::class, 'bookingList'])->name('booking');
    Route::get('booking/{booking}', [CustomerBookingController::class, 'bookingDetail'])->name('booking.detail');

    Route::get('booking-post/{post}', [CustomerBookingController::class, 'createBooking'])->name('booking.create');
    Route::post('booking-post/{post}', [CustomerBookingController::class, 'storeBooking'])->name('booking.store');

    Route::get('booking-payment/{booking}', [CustomerBookingController::class, 'bookingPaymentForm'])->name('booking.payment');
    Route::patch('booking-payment/{booking}', [CustomerBookingController::class, 'uploadBookingPayment'])->name('booking.upload-payment');
});

// Owner access
Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/booking', [OwnerBookingController::class, 'index'])->name('admin.booking.index');
    Route::get('/admin/booking/{booking}', [OwnerBookingController::class, 'show'])->name('admin.booking.view');
    Route::patch('/admin/booking/accept/{booking}', [OwnerBookingController::class, 'acceptBooking'])->name('admin.booking.accept');
    Route::patch('/admin/booking/reject/{booking}', [OwnerBookingController::class, 'rejectBooking'])->name('admin.booking.reject');

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
});
