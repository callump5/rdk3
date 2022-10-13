<?php

namespace App\Http\Controllers\Adminarea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('adminarea.dashboard.index', [
            'title' => 'Dashboard',
            'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio facilis nesciunt ipsam laborum nihil natus nostrum fugit eos dolorem cum id, ducimus quaerat corrupti eaque! Assumenda minima labore nemo mollitia.',
            // 'actions' => [
            //     [
            //         'text' => 'Queue Updates',
            //         'icon' => 'rotate',
            //         'id' => 'queue-updates',
            //     ],
            //     [
            //         'text' => 'Scaper',
            //         'icon' => 'dragon',
            //         'id' => 'scraper'
            //     ],
            // ],
            // 'model' => 'Game'
        ]);
    }
}
