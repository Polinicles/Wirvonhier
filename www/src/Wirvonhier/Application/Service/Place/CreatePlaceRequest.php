<?php

namespace Wirvonhier\Application\Service\Place;

use Wirvonhier\Domain\Helper\Assert;

class CreatePlaceRequest
{
    private $type;
    private $latitude;
    private $longitude;

    /**
     * CreatePlaceRequest constructor.
     * @param $type
     * @param $latitude
     * @param $longitude
     */
    public function __construct($type, $latitude, $longitude)
    {
        $this->setType($type);
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
    }

    /**
     * @return mixed
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        Assert::isString($type, 'type');

        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getLatitude() : float
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude) : void
    {
        Assert::isValidCoordenate($latitude, 'latitude');

        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude() : float
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude) : void
    {
        Assert::isValidCoordenate($longitude, 'longitude');

        $this->longitude = $longitude;
    }
}