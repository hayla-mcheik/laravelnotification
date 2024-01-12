<?php


use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\Ads;
use App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\VisitorsController;


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

Route::get('/login', [AdminAuth::class, 'loginpage'])->name('login');
Route::post('/admin/login', [AdminAuth::class, 'login'])->name('admin.login');
Route::post('/register', [CustomerAuth::class, 'register'])->name('customer.register');
Route::post('/admin/register', [AdminAuth::class, 'register'])->name('admin.register');


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [AdminAuth::class, 'dashboard']);
    Route::get('/dashboard', [AdminAuth::class, 'dashboard'])->name('admin.dashboard');




    Route::get('/logout', [AdminAuth::class, 'logout'])->name('admin.logout');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
