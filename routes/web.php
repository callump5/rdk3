<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Adminarea\DashboardController;
use App\Http\Controllers\Adminarea\ScraperController;
use App\Http\Controllers\GameController;
use App\Models\Adminarea\Scraper\CurlSession;
use App\Models\Adminarea\Scraper\Scraper;

use App\Jobs\ScrapeProduct;
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


    Route::resource('games', GameController::class);

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function() {

//     // Init Curl Session
//     $curlSession = new CurlSession();

//     // Init Scraper and pass CurlSession as Dependency
//     $scraper = new Scraper($curlSession);

//     // Set the interface for the scraper
//     $scraper->setInterface('cdkeys');
// //    $scraper->setInterface('g2a');

//     // Scrape Product
//     $scraper->searchProduct();
// //    $scraper->scrapeProduct('https://www.g2a.com/search/api/v3/suggestions?include[]=categories&itemsPerPage=4&phrase=Sniper Elite 5&currency=GBP');



    $data = [
        "name" => 'testGame',
        "href" => 'https://www.cdkeys.com/pc/fifa-23-pc-en-origin',
        "platform" => 'PC',
        "category" => 'Sports',
        "collection" => 'Fifa'
    ];

    ScrapeProduct::dispatch($data);

});
