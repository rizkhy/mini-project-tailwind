<?php

use App\Livewire\Dashboard\DashboardPage;
use App\Livewire\Login\LoginPage;
use App\Livewire\Payment\PaymentPage;
use App\Livewire\Reimbursement\ReimbursementPage;
use App\Livewire\User\UserPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', LoginPage::class)->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');

    Route::get('/reimbursements', ReimbursementPage::class)->name('reimbursement');

    Route::get('/user', UserPage::class)->name('user');

    Route::get('/payment', PaymentPage::class)->name('payment');
});
