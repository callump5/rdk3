<?php

namespace App\Http\Livewire\Adminarea\Scraper;

use App\Models\Adminarea\Scraper\CurlSession;
use App\Models\Adminarea\Scraper\Scraper;
use App\Models\Game;
use Livewire\Component;

class GameWizard extends Component
{

    public $product = [];
    public $drivers = [];

    public array $scrapedData = [
        'name' => '',
        'description' => '',
        'platforms' => '',
        'cdkeys_price' => 0.00,
        'g2a_price' => 0.00,
        'cdkeys_link' => '',
        'g2a_link' => '',
        'image_path' => '',
    ];


    public $productData = [];
    public $steps = 3;
    public $currentStep = 1;
    public $progress;
    public $url;

    protected $listeners = [
        'nextStep' => 'nextStep',
        'scrapeProduct' => 'scrapeProduct',
        'createProduct' => 'createProduct',
        'getData' => 'getData'
    ];

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

    public function getData($key){
        return $this->scrapedData[$key];
    }

    public function scrapeProduct()
    {
        // Check to see if the game exists
        $game = Game::where('cdkeys_link', $this->url)->get();

        // If the game exists throw an error message
        if(count($game) > 0){
            $this->dispatchBrowserEvent('scraperError', [
                'type' => 'error',
                'message' => 'This game already exists!'
            ]);
            return;
        }

        // Init Curl Session
        $curlSession = new CurlSession();

        // Init Scraper and pass CurlSession as Dependency
        $scraper = new Scraper($curlSession);

        // Loop through selected drivers
        foreach($this->drivers as $driver)
        {
            // Set the interface for the scraper
            $scraper->setInterface($driver);

            $product = $scraper->loadProduct($this->url, $this->scrapedData['name']);

            $productData = $scraper->scrapeProduct($product);

            if(isset($productData['type']) && $productData['type'] === 'error'){
                $this->dispatchBrowserEvent('scraperError', [
                    'type' => $productData['type'],
                    'message' => $productData['message'],
                ]);
                return;
            }


            $this->product[$driver . '_url'] = $product;
            // Scrape Product

            // Map the data

            if(count($this->drivers) === 1){
                $this->scrapedData['name'] = $productData['name'];
                $this->scrapedData['description'] = $productData['description'] ?? "";
                $this->scrapedData['platforms'] = $productData['platforms'] ?? "";
                $this->scrapedData['cdkeys_price'] = $productData['cdkeys_price'] ?? 0.00;
                $this->scrapedData['g2a_price'] = $productData['g2a_price'] ?? 0.00;
                $this->scrapedData['cdkeys_link'] = $productData['cdkeys_link'] ?? null;
                $this->scrapedData['g2a_link'] = $productData['g2a_link'] ?? null;
                $this->scrapedData['image_path'] = $productData['image_path'] ?? null;
            } else {
                if($driver === 'cdkeys'){
                    $this->scrapedData['name'] = $productData['name'];
                    $this->scrapedData['description'] = $productData['description'] ?? "";
                    $this->scrapedData['platforms'] = $productData['platforms'] ?? "";
                    $this->scrapedData['image_path'] = $productData['image_path'] ?? null;
                }

                $this->scrapedData[$driver . '_price'] = $productData[$driver . '_price'] ?? 0.00;
                $this->scrapedData[$driver . '_link'] = $this->product[$driver . '_url'] ?? null;


                if($driver === 'g2a'){
                    $this->scrapedData[$driver . '_link'] = $productData['slug'];
                }


            }

            $this->dispatchBrowserEvent('scrapeProduct', [
                'description' => $this->scrapedData['description'],
                'imagePath' => $this->scrapedData['image_path']
            ]);

        }


        $this->nextStep();
    }

    public function createProduct()
    {
        $game = Game::where('cdkeys_link', $this->scrapedData['cdkeys_link'])->get();

        if(count($game) > 0){
            $this->dispatchBrowserEvent('scraperError', [
                'type' => 'error',
                'message' => 'This game already exists!'
            ]);
            return;
        }

        $g2a_game = Game::where('g2a_link', $this->scrapedData['g2a_link'])->get();
        $cd_game = Game::where('cdkeys_link', $this->scrapedData['cdkeys_link'])->get();
        // If the game exists throw an error message
        if(count($cd_game) > 0 || count($g2a_game) > 0){
            $this->dispatchBrowserEvent('scraperError', [
                'type' => 'error',
                'message' => 'This game already exists!'
            ]);
            return;
        }
        

        $this->game = Game::updateOrCreate(
            [$this->drivers[0] . '_link' => $this->scrapedData[$this->drivers[0] . '_link']],
            [
                'name' => $this->scrapedData['name'],
                'description' => $this->scrapedData['description'],
                'image_path' => $this->scrapedData['image_path'],
                'g2a_link' => $this->scrapedData['g2a_link'],
                'cdkeys_link' => $this->scrapedData['cdkeys_link'],
                'g2a_price' => $this->scrapedData['g2a_price'],
                'cdkeys_price' => $this->scrapedData['cdkeys_price'],
                'platforms' => $this->scrapedData['platforms'],

            ]
        );

        $this->game->image_path = $this->scrapedData['image_path'];
        $this->game->save();
        $this->nextStep();



    }

    public function render()
    {
        return view('livewire.adminarea.scraper.game-wizard');
    }
}
