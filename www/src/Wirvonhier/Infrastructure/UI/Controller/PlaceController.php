<?php

namespace Wirvonhier\Infrastructure\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Wirvonhier\Application\Service\Place\CreatePlaceRequest;
use Wirvonhier\Application\Service\Place\CreatePlaceService;
use Wirvonhier\Application\Transformer\Place\PlaceTransformer;
use Wirvonhier\Domain\Exception\Validation\InvalidParamTypeException;

class PlaceController extends AbstractController
{
    /**
     * @var CreatePlaceService
     */
    private $createPlaceService;

    /**
     * PlaceController constructor.
     * @param CreatePlaceService $createPlaceService
     */
    public function __construct(CreatePlaceService $createPlaceService)
    {
        $this->createPlaceService = $createPlaceService;
    }


    /**
     * @Route("/place", name="place.create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $createPlaceRequest = new CreatePlaceRequest(
                $request->get('type'),
                $request->get('latitude'),
                $request->get('longitude')
            );

            $place = $this->createPlaceService->execute($createPlaceRequest);

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
            'data' => (new PlaceTransformer())->transform($place)
        ], Response::HTTP_CREATED);
    }
}