<?php

namespace App\Service;

class EstateListingSiteCrawlerChain implements EstateListingSiteCrawlerInterface
{
    private $listingSiteCrawlers;

    public function __construct()
    {
        $this->listingSiteCrawlers = [];
    }

    public function addCrawler(EstateListingSiteCrawlerInterface $listingSiteCrawler): void
    {
        $this->listingSiteCrawlers[] = $listingSiteCrawler;
    }

    /**
     * @inheritDoc
     */
    public function getEstates(): array
    {
        $results = [];

        foreach ($this->listingSiteCrawlers as $listingSiteCrawler) {
            $results = array_merge($results, $listingSiteCrawler->getEstates());
        }

        return $results;
    }
}