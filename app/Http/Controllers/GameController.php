<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Game;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $args = [
            'title' => 'Game Overview',
            'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio facilis nesciunt ipsam laborum nihil natus nostrum fugit eos dolorem cum id, ducimus quaerat corrupti eaque! Assumenda minima labore nemo mollitia.',
            'actions' => [
                [
                    'text' => 'Create',
                    'icon' => 'plus',
                    'route' => route('games.create'),
                ]
            ],
            'model' => 'Game'
        ];

        return view('adminarea.games.index', $args);
    }


    public function edit(Request $request, Game $game)
    {

        $args = [
            'title' => 'Editing ' . $game->name,
            'actions' => [
                [
                    'text' => 'Create',
                    'icon' => 'plus',
                    'route' => route('games.create')
                ]
            ],
            'game' => $game
        ];

        return view('adminarea.games.edit', $args);
    }

}

