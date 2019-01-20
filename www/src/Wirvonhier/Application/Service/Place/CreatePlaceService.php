<?php

namespace Wirvonhier\Application\Service\Place;

use Wirvonhier\Domain\Entity\Place;
use Wirvonhier\Domain\Entity\Repository\PlaceRepository;

class CreatePlaceService
{
    /**
     * @var PlaceRepository
     */
    private $placeRepository;

    /**
     * CreatePlaceService constructor.
     * @param PlaceRepository $placeRepository
     */
    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * Check if Place exists, otherwise create it
     *
     * @param CreatePlaceRequest $createPlaceRequest
     * @return Place
     */
    public function execute(CreatePlaceRequest $createPlaceRequest) : Place
    {
        $type       = $createPlaceRequest->getType();
        $latitude   = $createPlaceRequest->getLatitude();
        $longitude  = $createPlaceRequest->getLongitude();

        $existingPlace  = $this->placeRepository->findOneBy([
            'type'      => $type,
            'latitude'  => $latitude,
            'longitude' => $longitude
        ]);

        if(!is_null($existingPlace)) {
            return $existingPlace;
        }

        $newPlace = new Place();
        $newPlace->setType($createPlaceRequest->getType());
        $newPlace->setLatitude($createPlaceRequest->getLatitude());
        $newPlace->setLongitude($createPlaceRequest->getLongitude());

        return $this->placeRepository->save($newPlace);
    }
}