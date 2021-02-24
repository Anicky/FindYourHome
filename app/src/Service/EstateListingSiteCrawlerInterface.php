<?php

namespace App\Service;

use App\Entity\Estate;

interface EstateListingSiteCrawlerInterface
{

    /**
     * Returns a list of estates.
     *
     * @return Estate[]
     */
    public function getEstates(): array;

}