<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Models\Event;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', [EventController::class, 'home'])->name('home');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login', ['title' => 'Login']);
})->name('login')->middleware('guest');

Route::post('login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register', ['title' => 'Register']);
})->name('register')->middleware('guest');

Route::post('register', [AuthController::class, 'register'])->name('register.post')->middleware('guest');

Route::delete('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Profile Route
Route::get('/profile', function () {
    return view('profile', ['title' => 'Profile']);
})->name('profile')->middleware('auth');

// Dashboard Route
Route::get('dashboard', function () {
    $usersCount = User::all()->count();
    $eventsCount = Event::all()->count();
    $paymentsCount = Payment::all()->count();
    return view('panel.dashboard', [
        'title' => 'Dashboard',
        'usersCount' => $usersCount,
        'eventsCount' => $eventsCount,
        'paymentsCount' => $paymentsCount
    ]);
})->name('dashboard')->middleware(['auth', 'can:panel dashboard']);

// User Management Routes
Route::resource('users', UserController::class)->middleware(['auth', 'can:panel dashboard']);
Route::get('users-search', [UserController::class, 'search'])->name('users.search')->middleware(['auth', 'can:panel dashboard']);
Route::get('users/edit/{id}/password', [UserController::class, 'editPassword'])->name('edit-password');
Route::post('users/update/{id}/password', [UserController::class, 'updateUserPassword'])->name('users.update.password')->middleware(['auth', 'can:panel dashboard']);
Route::delete('user/delete-selected', [UserController::class, 'deleteSelected'])->name('users.deleteSelected')->middleware(['auth', 'can:panel dashboard']);

// Invoice Routes
Route::get('myinvoice', [InvoiceController::class, 'index'])->name('myinvoice')->middleware('auth');
Route::get('invoices/{invoice_number}', [InvoiceController::class, 'show'])->name('invoice.show')->middleware('auth');
Route::get('scan-ticket', function () {
    return view('panel.payment.scan', ['title' => 'Scan Ticket']);
})->name('invoice.scan')->middleware(['auth', 'can:panel dashboard']);

Route::post('/scan-ticket', [InvoiceController::class, 'scanTicket'])->name('invoice.scan.post')->middleware(['auth', 'can:panel dashboard']);
Route::get('/uri: scan-camera-ticket/{invoice_number}', [InvoiceController::class, 'scanTicket'])->name('invoice.cam.scan.post')->middleware(['auth', 'can:panel dashboard']);

// Event Management Routes
Route::resource('events', EventController::class)->middleware(['auth', 'can:panel dashboard']);
Route::get('events-search', [EventController::class, 'search'])->name('events.search')->middleware(['auth', 'can:panel dashboard']);
Route::get('events-public-search', [EventController::class, 'publicSearch'])->name('events.public.search');
Route::delete('event/delete-selected', [EventController::class, 'deleteSelected'])->name('events.deleteSelected')->middleware(['auth', 'can:panel dashboard']);

Route::get('event/{title}', function ($title) {
    $event = Event::where('title', $title)->first();
    return view('detail-event', ['title' => $title, 'event' => $event]);
})->name('event.detail');

// Payment Routes
Route::get('mypayment', [PaymentController::class, 'myPayment'])->name('mypayment')->middleware('auth');
Route::get('payments/{payment_id}', [PaymentController::class, 'show'])->name('payments.show')->middleware('auth');
Route::post('payments/{event_id}', [PaymentController::class, 'store'])->name('payments.store')->middleware('auth');
Route::post('payment-confirmation/{payment_id}/{status}/{order_id}', [PaymentController::class, 'update'])->name('payments.confirm')->middleware(['auth']);
Route::get('payments-search', [PaymentController::class, 'search'])->name('payments.search')->middleware(['auth', 'can:panel payments']);
Route::get('payments', [PaymentController::class, 'index'])->name('payments.index')->middleware(['auth', 'can:panel payments']);

Route::get('payment-finder', function () {
    return view('panel.payment.finder', ['title' => 'Payment Finder']);
})->name('payment.finder')->middleware(['auth', 'can:panel payments']);

Route::post('payment-finder', [PaymentController::class, 'paymentFinder'])->name('payment.finder')->middleware(['auth', 'can:panel payments']);

// Additional Routes
Route::get('terms-and-condition', function () {
    return view('terms-condition', ['title' => 'Terms & Condition']);
})->name('terms-condition');

Route::get('FAQ', function () {
    return view('FAQ', ['title' => 'Frequently Asked Questions']);
})->name('FAQ');
