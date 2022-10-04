<?php

namespace App\Http\Livewire\Adminarea\Scraper;

use Illuminate\Support\Str;

use App\Models\Adminarea\Scraper\CurlSession;
use App\Models\Adminarea\Scraper\Scraper;
use App\Models\Game;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Platform;

use Livewire\Component;
use Livewire\WithPagination;


use App\Jobs\ScrapeProduct;


class CategoryWizard extends Component
{

    // Form Defaults
    public $steps = 3;
    public $currentStep = 1;
    public $progress;

    public $formData = [
        'name' => '',
        'href' => '',
        'category' => '',
        'platform' => '',
        'collection' => '',
    ];

    public $updateList = [];
    public $games = [];


    protected $listeners = [
        'nextStep' => 'nextStep',
        'scrapeCategory' => 'scrapeCategory',
        'queueProductsToScrape' => 'queueProductsToScrape'
    ];

    public function addToUpdateList($id)
    {
        if(isset($this->updateList[$id])){
            unset($this->updateList[$id]);
        } else {
            $this->updateList[$id] = $id;
        }
    }

    public function calculateProgress()
    {
        $this->progressButtonText = ($this->currentStep !== 2) ?  'Next' : 'Complete';
        $this->progress = number_format(($this->currentStep / $this->steps) * 100, 0, '.', ',');
    }

    public function mount()
    {
        $this->calculateProgress();
    }

    public function nextStep()
    {
        if($this->currentStep !== $this->steps)
        {
           $this->currentStep++;
           $this->calculateProgress();
        }
    }

    public function previousStep()
    {
        if($this->currentStep > 1)
        {
            $this->currentStep--;
            $this->calculateProgress();
        }
    }


    public function toggleLoader($status){

        $this->dispatchBrowserEvent('toggleLoader', [
            'status' => $status,
        ]);

    }

    public function scrapeCategory()
    {
        // Init Curl Session
        $curlSession = new CurlSession();

        // Init Scraper and pass CurlSession as Dependency
        $scraper = new Scraper($curlSession);

        // Set the interface for the scraper
        $scraper->setInterface('cdkeys');


        if(isset($this->formData['pages']) && $this->formData['pages'] > 0){
            for($x = 0; $x < $this->formData['pages'] + 1; $x++){

                $urlData = $scraper->processInput($this->formData['href'], '');
                
                if($urlData['type'] == 'search') {
                    $data = $scraper->searchCategory($urlData['url'] . "?p={$x}", '.result-title a');
                } else {
                    $data = $scraper->searchCategory($this->formData['href'] . "?p={$x}", '.product-item-link');
                }

                foreach($data as $key => $value)
                {
                    $uuid = Str::uuid()->toString();
                    $this->games[$uuid] = $value;
                }
            }
        } else {
            $urlData = $scraper->processInput($this->formData['href'], '');

            if($urlData['type'] == 'search') {
                $this->games = $scraper->searchCategory($urlData['url'], '.result-title a');
            } else {
                $this->games = $scraper->searchCategory($this->formData['href'], '.product-item-link');
            }
        }


        $this->toggleLoader('finished');


        $this->nextStep();

    }

    public function queueProductsToScrape()
    {
        foreach($this->updateList as $game)
        {
            $game = $this->games[$game];

            $data = [
                "name" => $game["name"],
                "href" => $game["href"],
                "platform" => $this->formData['platform'],
                "category" => $this->formData['category'],
                "collection" => $this->formData['collection']
            ];
            
            ScrapeProduct::dispatch($data);
        }

        $this->nextStep();
    }
    

    public function render()
    {

        $categories = Category::index();
        $collections = Collection::index();
        $platforms = Platform::index();

        if(isset($this->formData['platform']) && $this->formData['platform'] !== '')
        {
            $platforms->where("name", "LIKE", "%{$this->formData['platform']}%");
        }

        if(isset($this->formData['category']) && $this->formData['category'] !== '')
        {
            $categories->where("name", "LIKE", "%{$this->formData['category']}%");
        }

        if(isset($this->formData['collection']) && $this->formData['collection'] !== '')
        {
            $collections->where("name", "LIKE", "%{$this->formData['collection']}%");
        }


        return view('livewire.adminarea.scraper.category-wizard')->with([
            "categories" => $categories->get(),
            "collections" => $collections->get(),
            "platforms" => $platforms->get()
        ]);;
    }
}
