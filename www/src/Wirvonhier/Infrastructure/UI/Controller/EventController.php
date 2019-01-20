<?php

namespace Wirvonhier\Infrastructure\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Wirvonhier\Application\Service\Event\CreateEventRequest;
use Wirvonhier\Application\Service\Event\CreateEventService;
use Wirvonhier\Application\Service\Event\GetEventByIDRequest;
use Wirvonhier\Application\Service\Event\GetEventByIDService;
use Wirvonhier\Application\Service\Event\GetEventsByRadiusRequest;
use Wirvonhier\Application\Service\Event\GetEventsByRadiusService;
use Wirvonhier\Application\Transformer\Event\EventCollectionTransformer;
use Wirvonhier\Domain\Exception\Place\PlaceNotFoundException;
use Wirvonhier\Domain\Exception\Validation\InvalidParamTypeException;
use Wirvonhier\Application\Transformer\Event\EventTransformer;

class EventController extends AbstractController
{
    /**
     * @var CreateEventService
     */
    private $createEventService;
    /**
     * @var GetEventsByRadiusService
     */
    private $getEventsByRadiusService;
    /**
     * @var GetEventByIDService
     */
    private $getEventByIDService;

    /**
     * EventController constructor.
     * @param CreateEventService $createEventService
     * @param GetEventsByRadiusService $getEventsByRadiusService
     * @param GetEventByIDService $getEventByIDService
     */
    public function __construct(CreateEventService $createEventService,
                                GetEventsByRadiusService $getEventsByRadiusService,
                                GetEventByIDService $getEventByIDService)
    {
        $this->createEventService       = $createEventService;
        $this->getEventsByRadiusService = $getEventsByRadiusService;
        $this->getEventByIDService      = $getEventByIDService;
    }

    /**
     * @Route("/event/radius={radius}&latitude={latitude}&longitude={longitude}", name="event_radius", methods={"GET"})
     * @param $radius
     * @param $latitude
     * @param $longitude
     * @return JsonResponse
     */
    public function getByRadius($radius, $latitude, $longitude)
    {
        try {
            $getEventsByRadius  = new GetEventsByRadiusRequest(
                $radius,
                $latitude,
                $longitude
            );
            $events             = $this->getEventsByRadiusService->execute($getEventsByRadius);

        } catch (InvalidParamTypeException $exception) {

            return new JsonResponse([
                'message'      => $exception->getMessage(),
                'status_code'  => $exception->getCode()
            ], $exception->getCode());
        } catch (\Exception $exception) {

            return new JsonResponse([
                'message'      => $exception->getMessage(),
                'status_code'  => $exception->getCode()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse([
            'data' => (new EventCollectionTransformer())->transform($events)
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/event/", name="event_create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $createEventRequest = new CreateEventRequest(
                $request->get('type'),
                $request->get('place')
            );

            $event = $this->createEventService->execute($createEventRequest);

        } catch (InvalidParamTypeException | PlaceNotFoundException $exception) {

            return new JsonResponse([
                'message'      => $exception->getMessage(),
                'status_code'  => $exception->getCode()
            ], $exception->getCode());

        } catch (\Exception $exception) {

            return new JsonResponse([
                'message'      => $exception->getMessage(),
                'status_code'  => $exception->getCode()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse([
            'data' => (new EventTransformer())->transform($event)
        ], Response::HTTP_CREATED);
    }

    /**
     * @Route("/event/{id}", name="event_show", methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $getEventByIDRequest = new GetEventByIDRequest($id);
            $event = $this->getEventByIDService->execute($getEventByIDRequest);

        } catch (InvalidParamTypeException | PlaceNotFoundException $exception) {

            return new JsonResponse([
                'message'      => $exception->getMessage(),
                'status_code'  => $exception->getCode()
            ], $exception->getCode());

        } catch (\Exception $exception) {

            return new JsonResponse([
                'message'      => $exception->getMessage(),
                'status_code'  => $exception->getCode()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse([
            'data' => (new EventTransformer())->transform($event)
        ], Response::HTTP_CREATED);
    }
}