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

class UpdateProductPrices implements ShouldQueue
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


        $game = Game::find($this->data['product_id']);
        // Loop through selected drivers
        foreach($this->drivers as $driver)
        {

            // Set the interface for the scraper
            $scraper->setInterface($driver);

            $link = ($driver === 'cdkeys') ? $game->cdkeys_link : $game->g2a_link;

            $product = $scraper->loadProduct($link, $game->name);

            $scrapedData = $scraper->scrapeProduct($product);


            switch($driver){
                case('cdkeys'):
                    $game->cdkeys_price = $scrapedData['cdkeys_price'] ?? 0.00;
                    $game->save();

                    break;
                case('g2a'):
                    $game->g2a_price = $scrapedData['g2a_price'] ?? 0.00;
                    $game->save();

                    break;
            }
        }

        $curlSession->closeGuzzle();

    }
}
