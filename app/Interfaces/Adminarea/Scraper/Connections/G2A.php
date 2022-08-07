<?php

namespace App\Interfaces\Adminarea\Scraper\Connections;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Interfaces\Adminarea\Scraper\ScraperInterface;

class G2A implements ScraperInterface
{
    private $_pageData;
    private $_cleanedPageData;
    private $_scopedItemData;

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
    public function cleanPageData($page, $failSilently = false): void
    {
        $this->_cleanedPageData = json_decode($page);


        if(!isset($this->_cleanedPageData->data->items[0])){
            if($failSilently){
                return;
            } else {
                throw new \InvalidArgumentException('Page not found on G2A.');
            }
        }

        $this->_scopedItemData = $this->_cleanedPageData->data->items[0];
    }


    // -- Self explanatory functions --------------------------/

    public function getPriceFromPage(): float
    {
        if(isset($this->_scopedItemData->price)){
            return floatval($this->_scopedItemData->price);
        } else {
            return 0.00;
        }
    }

    public function getNameFromPage(): string
    {
        return $this->_scopedItemData->name ?? '';
    }


    public function getDescriptionFromPage() : string
    {
        return '';
    }

    public function getUrlFromPage() : string
    {
        return $this->_scopedItemData->slug ?? '';
    }

    public function getCategoriesFromPage(): array
    {
        return [];
    }

    public function getPlatformFromPage(): string
    {
        return $this->_scopedItemData->platform->name ?? '';
    }

    public function getPlatformRequirementFromPage() : string
    {
        return '';
    }

    public function getImageFromPage() : string
    {
        return 'images/placeholder.jpeg';
    }
}
