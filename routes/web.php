<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

// ✅ Admin routes
Route::middleware(['is.admin'])->group(function () {
    // Employees Management
    Route::resource('users', UserController::class);



    // Assign customers (Blade: assign.blade.php)
    // Route::get('customers/assign', [CustomerController::class, 'assignView'])->name('customers.assign');
    // Route::post('customers/assign', [CustomerController::class, 'assign'])->name('customers.assign.store');
});

// ✅ Employee routes
Route::middleware(['auth', 'check.role'])->group(function () {
    // Customers they created
    Route::get('my-customers', [CustomerController::class, 'myCustomers'])->name('customers.my');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    // Route::get('/customers/{customer}/actions/create', [ActionController::class, 'create'])
    // ->name('customers.actions.create');
    // Route::post('/customers/{customer}/actions', [ActionController::class, 'store'])
    // ->name('customers.actions.store');
    Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');


    // Customers (All customers)
    Route::resource('customers', CustomerController::class);
    // Actions
    Route::resource('actions', ActionController::class);
    Route::prefix('customers/{customer}')->group(function () {
    // Route::get('/actions', [ActionController::class, 'index'])->name('customers.actions.index');
    // Route::get('/actions/create', [ActionController::class, 'create'])->name('customers.actions.create');
    // Route::post('/actions', [ActionController::class, 'store'])->name('customers.actions.store');
});
    Route::post('/actions/store', [ActionController::class, 'store'])->name('customers.actions.store');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
