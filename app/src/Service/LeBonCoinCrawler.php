<?php

// src/Service/LeBonCoinCrawler.php
namespace App\Service;

use App\Entity\Estate;
use App\Entity\EstateType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LeBonCoinCrawler implements EstateListingSiteCrawlerInterface
{

    private HttpClientInterface $client;

    private EntityManagerInterface $entityManager;

    const ESTATE_TYPE_HOUSE = 1;

    const ESTATE_TYPE_FLAT = 2;

    const ESTATE_CATEGORY_SALE = 9;

    const ESTATE_CATEGORY_RENTAL = 10;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $entityManager)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function getEstates(): array
    {
        // Params
        $base_url = 'https://www.leboncoin.fr/recherche';
        $estateTypeName = 'Maison';
        $location = 'Lyon';
        $zipCode = '69008';
        $priceMin = 'min';
        $priceMax = '800000';
        $type = self::ESTATE_TYPE_HOUSE;
        $roomsMin = '4';
        $roomsMax = 'max';
        $surfaceAreaMin = '70';
        $surfaceAreaMax = 'max';
        $category = self::ESTATE_CATEGORY_SALE;
        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0';
        $itemSelector = 'a[data-qa-id="aditem_container"]';
        $itemTitleSelector = 'p[data-qa-id="aditem_title"]';
        $itemPriceSelector = 'span[data-qa-id="aditem_price"]';
        $moneyCurrencySymbol = '€';

        $data = http_build_query(
            [
                'category' => $category,
                'locations' => $location.'_'.$zipCode,
                'real_estate_type' => $type,
                'price' => $priceMin.'-'.$priceMax,
                'rooms' => $roomsMin.'-'.$roomsMax,
                'square' => $surfaceAreaMin.'-'.$surfaceAreaMax,
            ]
        );

        $url = $base_url.'?'.$data;

        $response = $this->client->request(
            'GET',
            $url,
            [
                'headers' => [
                    'User-Agent' => $userAgent,
                ],
            ]
        );

        $crawler = new Crawler($response->getContent());
        $crawler = $crawler->filter($itemSelector);

        $estateType = $this->entityManager->getRepository(EstateType::class)->findOneBy(
            [
                'name' => $estateTypeName,
            ]
        );

        $estates = [];

        foreach ($crawler as $domElement) {
            foreach ($domElement->childNodes as $node) {
                $html_node = $node->ownerDocument->saveHTML($node);
                $node_crawler = new Crawler($html_node);
                $title = $node_crawler->filter($itemTitleSelector)->getNode(0)->nodeValue;
                $price = $node_crawler->filter($itemPriceSelector)->getNode(0)->nodeValue;
                $price_formatted = intval(str_replace(' ', '', str_replace($moneyCurrencySymbol, '', $price)));

                $estate = new Estate();
                $estate->setTitle($title);
                $estate->setEstateType($estateType);
                $estate->setPrice($price_formatted);
                $estate->setLocation($location);
                $estate->setPublicationDate(new DateTime()); // @TODO
                $estate->setSurfaceArea(0); // @TODO
                $estate->setNumberOfPieces(0); // @TODO
                $estate->setDescription(''); // @TODO

                $estates[] = $estate;
            }

        }

        return $estates;
    }
}