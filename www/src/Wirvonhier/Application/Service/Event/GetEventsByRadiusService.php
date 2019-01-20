<?php

namespace Wirvonhier\Application\Service\Event;

use Wirvonhier\Domain\Entity\Event;
use Wirvonhier\Domain\Entity\Repository\EventRepository;

class GetEventsByRadiusService
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * GetEventsByRadiusService constructor.
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Get all events and check if their place is inside the specific radius
     *
     * @param GetEventsByRadiusRequest $getEventsByRadiusRequest
     * @return array
     */
    public function execute(GetEventsByRadiusRequest $getEventsByRadiusRequest) : array
    {
        $availableEvents = $this->eventRepository->findAll();
        $latitude        = $getEventsByRadiusRequest->getLatitude();
        $longitude       = $getEventsByRadiusRequest->getLongitude();
        $radius          = $getEventsByRadiusRequest->getRadius();
        $eventsInRadius  = [];

        /* @var Event $event */
        foreach ($availableEvents as $event) {
            $place      = $event->getPlace();
            $placeLat   = $place->getLatitude();
            $placeLng   = $place->getLongitude();
            $distance   = $this->getDistance($latitude, $longitude, $placeLat, $placeLng);

            if($distance <= $radius) {
                array_push($eventsInRadius, $event);
            }
        }

        return $eventsInRadius;
    }

    /**
     * Calculate distance from two points (in km's)
     *
     * @param $latitude1
     * @param $longitude1
     * @param $latitude2
     * @param $longitude2
     * @return float|int
     */
    public function getDistance($latitude1, $longitude1, $latitude2, $longitude2 ) {
        $earth_radius = 6371;

        $dLat   = deg2rad( $latitude2 - $latitude1 );
        $dLon   = deg2rad( $longitude2 - $longitude1 );
        $a      = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2)
            * sin($dLon/2);
        $c      = 2 * asin(sqrt($a));
        $d      = $earth_radius * $c;

        return $d;
    }
}