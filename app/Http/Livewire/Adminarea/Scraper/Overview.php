<?php

namespace App\Http\Livewire\Adminarea\Scraper;

use App\Models\Game;
use Livewire\Component;

class Overview extends Component
{

    public $search = [];
    public $perPage = 40;

    public $updateList = [];

    public function addToUpdateList($id)
    {
        if(isset($this->updateList[$id])){
            unset($this->updateList[$id]);
        } else {
            $this->updateList[$id] = $id;
        }
    }

    public function render()
    {
        $name = $this->search["name"] ?? "";

        $games = Game::index();

        if($name)
        {
            $games->where("name", "LIKE", "%{$name}%");
        }

        return view('livewire.adminarea.scraper.overview')->with([
            'games' => $games->paginate($this->perPage)
        ]);
    }
}
