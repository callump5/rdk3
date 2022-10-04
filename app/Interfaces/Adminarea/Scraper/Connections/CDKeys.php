<?php

namespace App\Interfaces\Adminarea\Scraper\Connections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use App\Interfaces\Adminarea\Scraper\ScraperInterface;
use DOMDocument;
use DomXPath;
use Storage;

class CDKeys implements ScraperInterface
{
    private $_pageData;
    private $_dom;
    private $_finder;
    public $cleanedDate;

    // Set Page Data
    public function setPageData($data): void
    {
        $this->_pageData = $data;
    }

    // Get the page data
    public function getPageData(): string
    {
        return $this->_pageData;
    }

    // Clean the page data
    public function cleanPageData($page): void
    {
        $this->_dom = new domDocument;
        libxml_use_internal_errors(true);
        $this->_dom->loadHTML($page, LIBXML_NOWARNING );
        $this->_finder = new DomXPath($this->_dom);
        $this->cleanedData = $this->_finder;
    }


    // Cycle through category page and build a list of products to scrape
    public function buildList() : void
    {

    }

    // Get the first result
    public function getFirstResult() : void
    {

    }

    // -- Self explanatory functions --------------------------/

    public function getPriceFromPage(): float
    {
        $dirtyPrice = $this->_finder->query("//div[@class='product-info-main']//span[@data-price-type='finalPrice']//span[@class='price']/text()")[0];
        return floatval(str_replace("£", '', $dirtyPrice->data));
    }

    public function getNameFromPage(): string
    {
        $dirtyName = $this->_finder->query("//div[@class='product-info-main']//h1//span/text()")[0];
        return $dirtyName->data;
    }


    public function getDescriptionFromPage() : string
    {
        $dirtyDescriptionNode = $this->_finder->query('//ul[@class="product_style_desc"]/li/text()');

        $descriptionHtml = "";

        foreach($dirtyDescriptionNode as $node){
            $descriptionHtml .= "<p>" . $node->data . "</p>";
        }

        return $descriptionHtml;
    }

    public function getUrlFromPage() : string
    {
        return '';
    }

    public function getCategoriesFromPage(): array
    {
        return [];
    }

    public function getPlatformFromPage(): string
    {
        return '';
    }

    public function getPlatformRequirementFromPage() : string
    {
        return '';
    }

    public function getImageFromPage() : string
    {
        $imgUrl = $this->_finder->query('//img[@class="gallery-placeholder__image"]')[0]->getAttribute('src');


        if(isset($imgUrl)) {
            $path = $this->downloadImage($imgUrl, $this->getNameFromPage() . ' cover image') ?? 'images/placeholder.jpeg';
            return $path;
        } else {
            return '';
        }
    }

    public function downloadImage($url, $name)
    {

        $opts = [
            "http" => [
                "method" =>"GET",
                "header" =>"Accept-language: en\r\n" .
                    "Cookie: foo=bar\r\n" .
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0\r\n"
            ]
        ];

        $context = stream_context_create($opts);

        $image = file_get_contents($url, false, $context);
        $ext = explode(".", $url)[3];
        $imagePath = "catalog/product-imgs/" . Str::slug($name, "-") . "." . $ext;
        if(Storage::put('public/'. $imagePath, $image)){
            return $imagePath;
        };
    }

}
