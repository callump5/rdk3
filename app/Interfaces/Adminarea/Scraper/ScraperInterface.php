<?php

namespace App\Interfaces\Adminarea\Scraper;

// Goal is to pass the page data and then return product data back to be created
interface ScraperInterface
{
    // Set the page data
    public function setPageData($data) : void;

    // Get the page data
    public function getPageData() : string;

    // Search the html with the passed classes
    public function cleanPageData($page) : void;


    // -- Self explanatory functions --------------------------/

    public function getPriceFromPage() : float;

    public function getNameFromPage() : string;

    public function getDescriptionFromPage() : string;

    public function getUrlFromPage() : string;

    public function getCategoriesFromPage() : array;

    public function getPlatformFromPage() : string;

    public function getPlatformRequirementFromPage() : string;

    public function getImageFromPage() : string;



}
