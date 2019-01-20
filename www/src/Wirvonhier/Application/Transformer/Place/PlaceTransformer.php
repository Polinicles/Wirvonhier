<?php

namespace Wirvonhier\Application\Transformer\Place;

use Wirvonhier\Application\Transformer\DataTransformerInterface;
use Wirvonhier\Domain\Entity\Place;

class PlaceTransformer implements DataTransformerInterface
{
    /**
     *
     * @param $place
     * @return array
     */
    public function transform($place) : array
    {
        /* @var Place $place */
        return [
            'id'        => $place->getId(),
            'type'      => $place->getType(),
            'latitude'  => $place->getLatitude(),
            'longitude' => $place->getLongitude()
        ];
    }
}