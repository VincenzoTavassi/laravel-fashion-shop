<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ShoeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
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

// # Guest route
Route::get('/',    [GuestHomeController::class,    'homepage'])->name('homepage');
Route::get('/shoes',    [GuestHomeController::class,    'showdetail'])->name('guest.detail');

// Admin route
Route::get('/home', [AdminHomeController::class, 'index'])->middleware('auth')->name('home');

// # Protected routes
Route::middleware('auth')
    ->prefix('admin')   // * routes url start with "/admin." 
    ->name('admin.')    // * routes name start with "admin." 
    ->group(
        function () {
            Route::get('shoes/trash', [ShoeController::class, 'trash'])->name('shoes.trash');
            Route::put('shoes/{shoe}/restore', [ShoeController::class, 'restore'])->name('shoes.restore');
            Route::delete('shoes/{shoe}/forcedelete', [ShoeController::class, 'forcedelete'])->name('shoes.forcedelete');
            Route::resource('shoes', ShoeController::class);
        }
    );

// ! Generated routes, do not touch
// # Protected profile's routes
Route::middleware('auth')
    ->prefix('profile')      // * routes url start with "/profile." 
    ->name('profile.')       // * routes name start with "profile." 
    ->group(
        function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        }
    );

require __DIR__ . '/auth.php';
