<?php

namespace App\Models\Adminarea\Scraper;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurlSession extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                "User-Agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0",
                "Accept"     => "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8",
                "Accept-language" => "en-GB,en;q=0.5",
                "Accept-Encoding" => "gzip, deflate"
            ],
            'cookies' => true
        ]);
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
            return $this->client->get($this->pageUrl)->getBody()->getContents();
        } catch (\Exception $e) {
            return $e;
        }

    }
}
