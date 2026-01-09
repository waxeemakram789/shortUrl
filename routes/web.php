<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ShortUrlController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth'])->group(function () {
    Route::get('/invite', [InvitationController::class, 'index'])->name('invite.index');
    Route::post('/invite', [InvitationController::class, 'store'])->name('invite.store');
      Route::get('/short-urls', [ShortUrlController::class, 'index'])->name('shorturls.index');

    Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('shorturls.store');
   
});
Route::get('/s/{code}', [ShortUrlController::class, 'redirect'])->name('shorturls.redirect');

require __DIR__.'/auth.php';
