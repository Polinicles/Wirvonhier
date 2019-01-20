<?php

namespace Wirvonhier\Application\Service\Event;

use Wirvonhier\Domain\Helper\Assert;

class CreateEventRequest
{
    private $type;
    private $placeID;

    /**
     * CreateEventRequest constructor.
     * @param $type
     * @param $placeID
     */
    public function __construct($type, $placeID)
    {
        $this->setType($type);
        $this->setPlaceID($placeID);
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) : void
    {
        Assert::isString($type, 'type');

        $this->type = $type;
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
    public function setPlaceID(int $placeID) : void
    {
        Assert::isInt($placeID, 'place');

        $this->placeID = $placeID;
    }
}