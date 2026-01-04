<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Temporary debug route — returns visit count and sample rows (remove in production)
Route::get('/debug/visits-count', function () {
    if (!app()->environment('local') && ! request()->ip() === '127.0.0.1') {
        abort(404);
    }
    $visits = \App\Models\Visit::orderBy('created_at', 'desc')->take(10)->get();
    return response()->json(['count' => \App\Models\Visit::count(), 'sample' => $visits]);
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

    // Task routes
    Route::resource('tasks', TaskController::class);
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

    // Subscription routes
    Route::get('/pricing', [SubscriptionController::class, 'pricing'])->name('pricing');
    Route::get('/subscription/upgrade', [SubscriptionController::class, 'upgrade'])->name('subscription.upgrade');
    Route::post('/subscription/payment', [SubscriptionController::class, 'createPayment'])->name('subscription.payment');
    Route::get('/subscription/finish/{transaction_id}', [SubscriptionController::class, 'finish'])->name('subscription.finish');
    Route::post('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::post('/subscription/continue/{id}', [SubscriptionController::class, 'continuePayment'])->name('subscription.continue');
    Route::post('/subscription/cancel-transaction/{id}', [SubscriptionController::class, 'cancelTransaction'])->name('subscription.cancel-transaction');

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware([\App\Http\Middleware\EnsureAdmin::class])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions');
        Route::get('/visits-data', [AdminController::class, 'visitsData'])->name('visits.data');
    });
});

// Midtrans callback (no auth middleware)
Route::post('/midtrans/callback', [SubscriptionController::class, 'callback'])->name('midtrans.callback');

require __DIR__.'/auth.php';
