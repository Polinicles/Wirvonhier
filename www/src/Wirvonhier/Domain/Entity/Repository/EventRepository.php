<?php

namespace Wirvonhier\Domain\Entity\Repository;

use Wirvonhier\Domain\Entity\Event;

interface EventRepository
{
    /**
     * @param $eventID
     * @return null|Event
     */
    public function findByID($eventID) : ?Event;

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param Event $event
     * @return null|Event
     */
    public function save(Event $event) : ?Event;
}