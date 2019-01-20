<?php

namespace Wirvonhier\Application\Service\Event;

use Wirvonhier\Domain\Entity\Event;
use Wirvonhier\Domain\Entity\Repository\EventRepository;
use Wirvonhier\Domain\Exception\Event\EventNotFoundException;

class GetEventByIDService
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * GetEventByIDService constructor.
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Get event by it's ID
     *
     * @param GetEventByIDRequest $request
     * @return Event
     * @throws EventNotFoundException
     */
    public function execute(GetEventByIDRequest $request) : Event
    {
        $event = $this->eventRepository->findByID($request->getEventID());

        if(is_null($event)) {
            throw new EventNotFoundException();
        }

        return $event;
    }
}