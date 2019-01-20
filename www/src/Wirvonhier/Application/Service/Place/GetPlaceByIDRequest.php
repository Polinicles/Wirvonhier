<?php

namespace Wirvonhier\Application\Service\Place;

use Wirvonhier\Domain\Helper\Assert;

class GetPlaceByIDRequest
{
    private $placeID;

    /**
     * GetPlaceByIDRequest constructor.
     * @param $placeID
     */
    public function __construct($placeID)
    {
        $this->setPlaceID($placeID);
    }

    /**
     * @return int
     */
    public function getPlaceID() : int
    {
        return $this->placeID;
    }

    /**
     * @param mixed $placeID
     */
    public function setPlaceID($placeID)
    {
        Assert::isInt($placeID, 'place');

        $this->placeID = $placeID;
    }
}