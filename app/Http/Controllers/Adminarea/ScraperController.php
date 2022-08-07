<?php

namespace App\Http\Controllers\Adminarea;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    //

    public function index()
    {
        return view('adminarea.scraper.index', [
            'games' => Game::all()
        ]);
    }

    public function games()
    {
        return view('adminarea.scraper.games');
    }

    public function categories()
    {
        return view('adminarea.scraper.categories');
    }
}
