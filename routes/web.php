<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLoanController;





Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pinjam', [UserLoanController::class, 'create'])->name('loan.create');
    Route::post('/pinjam', [UserLoanController::class, 'store'])->name('loan.store');
    Route::get('/riwayat', [UserLoanController::class, 'history'])->name('loan.history');
});

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
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});

require __DIR__.'/auth.php';
