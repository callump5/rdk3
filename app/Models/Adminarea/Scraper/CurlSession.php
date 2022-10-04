<?php

namespace App\Models\Adminarea\Scraper;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Panther\Client as Panther;
use GuzzleHttp\Client;

use Storage;


class CurlSession extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->list = [];
        $this->client = new Client([
            'headers' => [
                "User-Agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0",
                "Accept"     => "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8",
                "Accept-language" => "en-GB,en;q=0.5",
                "Accept-Encoding" => "gzip, deflate"
            ],
            'cookies' => true
        ]);
        $this->connection = null;
    }

    public function setPantherClient() : void
    {
        $this->panther = Panther::createChromeClient(base_path() . "/drivers/chromedriver");
    }

    public function getQueryList($selector)
    {
        $this->setPantherClient();

        $page = $this->panther->request('GET', $this->getPageUrl());

        // $img = $this->panther->takeScreenshot('screen.png'); // Yeah, screenshot!
        // Storage::put('scraper/' , $img);

        $links = array_filter($page->filter($selector)->each(function ($node)
        {
            return $node->attr('href');
        }));

        return $links;

    }

    public function getCategoryList($selector)
    {
        $this->setPantherClient();

        // dd($this->panther);

        $page = $this->panther->request('GET', $this->getPageUrl());

        // $img = $this->panther->takeScreenshot('screen.png'); // Yeah, screenshot!
        // Storage::put('scraper/' , $img);

        $links = array_filter($page->filter($selector)->each(function ($node)
        {

            if($node->text() === '') { return; }

            return [
                'name' => $node->text(),
                'href' => $node->attr('href')
            ];

        }));

        return $links;

    }

    public function closePanther(){
        $this->panther->close();
    }

    public function closeGuzzle(){
        $this->connection->close();
    }
    // Set the page to be scraped
    public function setPageUrl($link)
    {
        $this->pageUrl = $link;
    }

    public function getPageUrl() {
        return $this->pageUrl;
    }

    // Retrieve the page
    public function getPageData()
    {
        try {
            $this->connection = $this->client->get($this->pageUrl)->getBody();
            return $this->connection->getContents(); 
        } catch (\Exception $e) {
            return $e;
        }
    }

}
