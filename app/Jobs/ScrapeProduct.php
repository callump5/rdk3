<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Adminarea\Scraper\CurlSession;
use App\Models\Adminarea\Scraper\Scraper;
use App\Models\Game;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Platform;


use App\Models\CategoryGame;

use Spatie\InteractsWithPayload\Facades\AllJobs;

class ScrapeProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    
    protected $drivers = ['cdkeys', 'g2a'];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $productData = [];

        // Init Curl Session
        $curlSession = new CurlSession();

        // Init Scraper and pass CurlSession as Dependency
        $scraper = new Scraper($curlSession);


        // Loop through selected drivers
        foreach($this->drivers as $driver)
        {
            // Set the interface for the scraper
            $scraper->setInterface($driver);

            $product = $scraper->loadProduct($this->data['href'], $this->data['name']);

            $scrapedData = $scraper->scrapeProduct($product);

            $this->product[$driver . '_url'] = $product;

            switch($driver){
                case('cdkeys'):
                    $productData['name'] = $scrapedData['name'];
                    $productData['description'] = $scrapedData['description'] ?? "";
                    $productData['platforms'] = $scrapedData['platforms'] ?? "";
                    $productData['cdkeys_price'] = $scrapedData['cdkeys_price'] ?? 0.00;
                    $productData['g2a_price'] = $scrapedData['g2a_price'] ?? 0.00;
                    $productData['cdkeys_link'] = $scrapedData['cdkeys_link'] ?? null;
                    $productData['g2a_link'] = $scrapedData['g2a_link'] ?? null;
                    $productData['image_path'] = $scrapedData['image_path'] ?? null;
                    break;
                case('g2a'):
                    $productData['g2a_price'] = $scrapedData['g2a_price'] ?? 0.00;
                    $productData['g2a_link'] = $scrapedData['slug'] ?? null;
                    $productData['g2a_search_link'] = $scrapedData['g2a_link'] ?? null;
                    break;
            }
        }

        $curlSession->closeGuzzle();

        if(count(Game::where('cdkeys_link', $productData['cdkeys_link'])->get()) > 0) { return; }

        // // TODO :: MAKE IT SO WE CAN JUST ADD A STTING AND SCRAP THE RESULTS 
        $game = Game::create(
            [
                'name' => $productData['name'],
                'description' => $productData['description'],
                'image_path' => $productData['image_path'],
                'g2a_link' => $productData['g2a_link'],
                'g2a_search_link' => $productData['g2a_search_link'],
                'cdkeys_link' => $productData['cdkeys_link'],
                'g2a_price' => $productData['g2a_price'],
                'cdkeys_price' => $productData['cdkeys_price'],
            ]
        );


        if($this->data['category'] !== ''){

            $category = Category::where('name', $this->data['category'])->first();

            if($category === null) {
                $category = Category::create([
                    'name' => $this->data['category']
                ]);
                
            }

            $game->categories()->attach($category->id);       
        } 


        if($this->data['collection'] !== ''){
            
            $collection = Collection::where('name', $this->data['collection'])->first();

            if($collection === null) {
                $collection = Collection::create([
                    'name' => $this->data['collection']
                ]);
            }

            $game->collections()->attach($collection->id);   
        } 


        if($this->data['platform'] !== ''){
            
            $platform = Platform::where('name', $this->data['platform'])->first();

            if($platform === null) {
                $platform = Platform::create([
                    'name' => $this->data['platform']
                ]);
            }

            $game->platforms()->attach($platform->id);   
        } 

        $game->g2a_search_link = $productData['g2a_search_link'];
        $game->image_path = $productData['image_path'];
        $game->save();
        
    }
}
