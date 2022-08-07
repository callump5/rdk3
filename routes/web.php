<?php

use App\Http\Controllers\Adminarea\DashboardController;
use App\Http\Controllers\Adminarea\ScraperController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('adminarea.dashboard');

    Route::prefix('scraper')->group(function() {
        Route::get('/', [ScraperController::class, 'index'])->name('adminarea.scraper');
        Route::get('/games', [ScraperController::class, 'games'])->name('adminarea.scraper.games');
        Route::get('/categories', [ScraperController::class, 'categories'])->name('adminarea.scraper.categories');
    });

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
