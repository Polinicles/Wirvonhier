<?php

namespace Wirvonhier\Application\Service\Event;

use Wirvonhier\Domain\Helper\Assert;

class GetEventsByRadiusRequest
{
    private $radius;
    private $latitude;
    private $longitude;

    /**
     * GetEventsByRadiusRequest constructor.
     * @param $radius
     * @param $latitude
     * @param $longitude
     */
    public function __construct($radius, $latitude, $longitude)
    {
        $this->setRadius($radius);
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
    }

    /**
     * @return int
     */
    public function getRadius() : int
    {
        return $this->radius;
    }

    /**
     * @param mixed $radius
     */
    public function setRadius(int $radius) : void
    {
        Assert::isInt($radius, 'radius');

        $this->radius = $radius;
    }

    /**
     * @return float
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
        Assert::isValidCoordenate($latitude,'latitude');

        $this->latitude = $latitude;
    }

    /**
     * @return float
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
        Assert::isValidCoordenate($longitude,'longitude');

        $this->longitude = $longitude;
    }
}