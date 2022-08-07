<?php

namespace App\View\Components\Adminarea;

use Illuminate\View\Component;

class Navigation extends Component
{

    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->menu = [

            'dashboard' => [
                'label' => 'Dashboard',
                'url'   => '/',
                'icon'  => 'compass',
            ],
            'games' => [
                'label' => 'Games',
                'url'   => 'games',
                'icon'  => 'gamepad'
            ],
            'categories' => [
                'label' => 'Categories',
                'url'   => 'categories',
                'icon'  => 'list-tree'
            ],
            'platforms' => [
                'label' => 'Platforms',
                'url'   => 'platforms',
                'icon'  => 'tv'
            ],
            'scraper' => [
                'label' => 'Scraper',
                'url'   => 'scraper',
                'icon'  => 'spider-web'
            ],
            'settings' => [
                'label' => 'Settings',
                'url'   => 'settings',
                'icon'  => 'gear',
            ]

        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.adminarea.navigation');
    }
}
