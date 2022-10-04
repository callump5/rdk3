<?php

namespace App\Models\Adminarea\Scraper;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Adminarea\Scraper\CurlSession;
use App\Interfaces\Adminarea\Scraper\ScraperInterface;
use App\Models\Game;

class Scraper extends Model
{
    use HasFactory;

    public $curlSession;
    public $interface;
    public $scrapeList;

    // Array of available interface
    private $interfaces = [
        "g2a" => \App\Interfaces\Adminarea\Scraper\Connections\G2A::class,
        "cdkeys" => \App\Interfaces\Adminarea\Scraper\Connections\CDKeys::class
    ];

    public function __construct
    (
        CurlSession $curlSession
    )
    {
        $this->curlSession = $curlSession;
        $this->scrapeList = [];
    }

    // Set the interface to be used
    public function setInterface($text) : void
    {
        $this->interface = $text;
    }

    // Return the interface
    public function getInterface() 
    {
        return new $this->interfaces[$this->interface]();
    }

    // Returns search type and the full URL string
    public function processInput($input, $name) : array
    {
        if($this->interface === 'g2a'){
            if(isset($name) && $name !== ''){
                $name = str_replace('(WW)', '', $name);
                return [
                    'type' => 'direct',
                    'url' => "https://www.g2a.com/search/api/v3/suggestions?include[]=categories&itemsPerPage=4&phrase={$name}&currency=GBP"
                ];
            } else {
                return [
                    'type' => 'direct',
                    'url' => "https://www.g2a.com/search/api/v3/suggestions?include[]=categories&itemsPerPage=4&phrase={$input}&currency=GBP"
                ];
            }
        } elseif ($this->interface === 'cdkeys') {
            if(str_contains($input, 'https://')){
                return [
                    'type' => 'direct',
                    'url' => $input
                ];
            } else {
                return [
                    'type' => 'search',
                    'url' => "https://www.cdkeys.com/?q={$input}"
                ];
            }
        }
    }



    // Process input and load the product to scrape 
    public function loadProduct($input, $name) : string 
    {
        // Process the input and get the url info
        $urlData = $this->processInput($input, $name);

        if($urlData['type'] == 'search'){
            return $this->searchForProduct($urlData['url'], $name, '.result-thumbnail > a')[0];
        } else if($urlData['type'] == 'direct'){
            return $urlData['url'];
        }

    }


    public function searchForProduct($input, $name = null, $selector) : array
    {
        $this->curlSession->setPageUrl($input);

        $links = $this->curlSession->getQueryList($selector);

        return $links;
    }


    public function searchCategory($input, $selector) : array
    {
        $this->curlSession->setPageUrl($input);

        $links = $this->curlSession->getCategoryList($selector);

        return $links;
    }



    // Scrape product, the data will then be passed to another function to create/update
    public function scrapeProduct($link) : array
    {
        // Set the page URL
        $this->curlSession->setPageUrl($link);

        // Retrieve the page data
        $page = $this->curlSession->getPageData();

        if (gettype($page) !== 'string' && $page->getMessage()) {
            return [
                'type' => 'error',
                'message' => $page->getMessage()
            ];
        }
        // Init the interface
        $interface = $this->getInterface();

        // Pass the page data over the interface to clean
        try {
            $interface->cleanPageData($page);
        } catch (\Exception $e) {
            return [
                'type' => 'error',
                'message' => $e->getMessage()
            ];
        }


        // Get the needed values
        $data = [
            'name' => $interface->getNameFromPage(),
            $this->interface . '_price' => $interface->getPriceFromPage(),
            $this->interface . '_link' => $link,
            'description' => $interface->getDescriptionFromPage(),
            'platform' => $interface->getPlatformFromPage(),
            'slug' => $interface->getUrlFromPage(),
            'image_path' => $interface->getImageFromPage()
        ];

        return $data;
    }

}
