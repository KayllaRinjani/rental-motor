<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// tambahkan controller yang baru
use App\Http\Controllers\OwnerMotorController;
use App\Http\Controllers\AdminMotorController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\OwnerReportController;
use App\Http\Controllers\RenterReportController;
use App\Http\Controllers\AdminReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routing dashboard utama sesuai role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.reports.dashboard');
    } elseif ($user->role === 'owner' || $user->role === 'pemilik') {
        return redirect()->route('owner.dashboard'); // diarahkan ke dashboard owner
    } elseif ($user->role === 'user') {
        return redirect()->route('user.dashboard');
    } elseif ($user->role === 'penyewa') {
        return redirect()->route('motors.index');
    }

    // fallback kalau role tidak cocok
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==============================
// Dashboard per Role
// ==============================

// User
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

// Admin
Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/reports/dashboard', [AdminReportController::class, 'dashboard'])
        ->name('admin.reports.dashboard');

    Route::get('motors', [AdminMotorController::class,'index'])->name('admin.motors.index');
    Route::post('motors/{motor}/verify', [AdminMotorController::class,'verify'])->name('admin.motors.verify');

    Route::post('payments/{payment}/confirm', [PaymentController::class,'confirm'])->name('admin.payments.confirm');
    Route::post('payments/{payment}/reject', [PaymentController::class,'reject'])->name('admin.payments.reject');
});

// Owner (Pemilik)
Route::prefix('owner')->middleware(['auth','role:pemilik'])->group(function(){
    Route::get('/dashboard', function(){
        return view('owner.dashboard'); 
    })->name('owner.dashboard');

    Route::resource('motors', OwnerMotorController::class)->names('owner.motors');
    Route::get('revenue', [OwnerReportController::class,'revenue'])->name('owner.revenue');
});

// ==============================
// Profile
// ==============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// =====================================================
// Tambahan routes untuk Motor, Booking, Payment
// =====================================================
Route::middleware(['auth'])->group(function(){

    // umum lihat motor
    Route::get('/motors', [MotorController::class,'index'])->name('motors.index');
    Route::get('/motors/{motor}', [MotorController::class,'show'])->name('motors.show');

    // penyewa booking & payments
    Route::middleware('role:penyewa')->group(function(){
        Route::post('bookings', [BookingController::class,'store'])->name('bookings.store');
        Route::get('bookings/{booking}', [BookingController::class,'show'])->name('bookings.show');
        Route::get('bookings/history', [BookingController::class,'history'])->name('bookings.history');

        // laporan penyewa
        Route::get('renter/history', [RenterReportController::class,'history'])->name('renter.history');
    });

    // upload bukti pembayaran
    Route::post('payments/{payment}/upload', [PaymentController::class,'uploadProof'])->name('payments.upload');
});
