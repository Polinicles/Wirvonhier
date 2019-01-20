<?php

namespace Wirvonhier\Application\Service\Event;

use Wirvonhier\Application\Service\Place\GetPlaceByIDRequest;
use Wirvonhier\Application\Service\Place\GetPlaceByIDService;
use Wirvonhier\Domain\Entity\Event;
use Wirvonhier\Domain\Entity\Repository\EventRepository;
use Wirvonhier\Domain\Exception\Place\PlaceNotFoundException;

class CreateEventService
{
    /**
     * @var GetPlaceByIDService
     */
    private $getPlaceByIDService;
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * CreateEventService constructor.
     * @param GetPlaceByIDService $getPlaceByIDService
     * @param EventRepository $eventRepository
     */
    public function __construct(GetPlaceByIDService $getPlaceByIDService,
                                EventRepository $eventRepository)
    {
        $this->getPlaceByIDService  = $getPlaceByIDService;
        $this->eventRepository      = $eventRepository;
    }

    /**
     * Create a new Event (if Place exists)
     *
     * @param CreateEventRequest $request
     * @return Event
     * @throws PlaceNotFoundException
     */
    public function execute(CreateEventRequest $request) : Event
    {
        $newEvent   = new Event();
        $newEvent->setType($request->getType());

        $place      = $this->getPlaceByIDService->execute(
            new GetPlaceByIDRequest($request->getPlaceID())
        );
        $newEvent->setPlace($place);

        return $this->eventRepository->save($newEvent);
    }
}