<?php

namespace App\Http\Livewire\Adminarea;

use App\Jobs\UpdateProductPrices;
use Livewire\Component;


class Overview extends Component
{

    public $model;
    public $search = [];
    public $perPage = 40;


    public function mount($model){
        $this->model = trim('App\Models\ '). $model;
    }

    public function render()
    {
        $name = $this->search["name"] ?? "";

        $items = call_user_func($this->model .'::index'); // >5.2.3
        // $games = Game::index();

        if($name)
        {
            $items->where("name", "LIKE", "%{$name}%");
        }

        return view('livewire.adminarea.overview')->with([
            'games' => $items->paginate($this->perPage)
        ]);
    }
}
