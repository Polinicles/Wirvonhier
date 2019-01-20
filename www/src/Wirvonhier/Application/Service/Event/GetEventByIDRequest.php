<?php

namespace Wirvonhier\Application\Service\Event;

use Wirvonhier\Domain\Helper\Assert;

class GetEventByIDRequest
{
    private $eventID;

    /**
     * GetEventByIDRequest constructor.
     * @param $eventID
     */
    public function __construct($eventID)
    {
        $this->setEventID($eventID);
    }

    /**
     * @return int
     */
    public function getEventID() : int
    {
        return $this->eventID;
    }

    /**
     * @param mixed $eventID
     */
    public function setEventID(int $eventID)
    {
        Assert::isInt($eventID, 'event');

        $this->eventID = $eventID;
    }
}