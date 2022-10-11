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
            'title' => 'Scraper Overview',
            'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio facilis nesciunt ipsam laborum nihil natus nostrum fugit eos dolorem cum id, ducimus quaerat corrupti eaque! Assumenda minima labore nemo mollitia.',
            'actions' => [
                [
                    'text' => 'Queue Updates',
                    'icon' => 'rotate',
                    'id' => 'queue-updates',
                ],
                [
                    'text' => 'Scaper',
                    'icon' => 'dragon',
                    'id' => 'scraper'
                ],
            ],
            'model' => 'Game'
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
