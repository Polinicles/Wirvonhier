<?php

namespace Wirvonhier\Domain\Entity\Repository;

use Wirvonhier\Domain\Entity\Place;

interface PlaceRepository
{
    /**
     * @param Place $place
     * @return null|Place
     */
    public function save(Place $place) : ?Place;

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return mixed
     */
    public function findOneBy(array $criteria, array $orderBy = null);

    /**
     * @param $placeID
     * @return null|Place
     */
    public function findByID($placeID) : ?Place;
}