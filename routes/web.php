<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\NewsletterController;
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

Route::get('/signup', [NewsletterController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [NewsletterController::class, 'store'])->name('store');
Route::get('/unsubscribe/{email}', [NewsletterController::class, 'unsubscribe'])->name('unsubscribe');


