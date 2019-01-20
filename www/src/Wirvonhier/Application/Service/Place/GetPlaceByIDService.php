<?php

namespace Wirvonhier\Application\Service\Place;

use Wirvonhier\Domain\Entity\Place;
use Wirvonhier\Domain\Entity\Repository\PlaceRepository;
use Wirvonhier\Domain\Exception\Place\PlaceNotFoundException;

class GetPlaceByIDService
{
    /**
     * @var PlaceRepository
     */
    private $placeRepository;

    /**
     * GetPlaceByIDService constructor.
     * @param PlaceRepository $placeRepository
     */
    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * Return a Place by it's ID
     *
     * @param GetPlaceByIDRequest $request
     * @return null|Place
     * @throws PlaceNotFoundException
     */
    public function execute(GetPlaceByIDRequest $request) : ?Place
    {
        $place = $this->placeRepository->findByID($request->getPlaceID());

        if(is_null($place)){
            throw new PlaceNotFoundException();
        }

        return $place;
    }
}