<?php

namespace Wirvonhier\Application\Transformer\Event;

use Wirvonhier\Application\Transformer\DataTransformerInterface;
use Wirvonhier\Application\Transformer\Place\PlaceTransformer;
use Wirvonhier\Application\Transformer\Post\PostCollectionTransformer;
use Wirvonhier\Domain\Entity\Event;

class EventTransformer implements DataTransformerInterface
{
    /**
     * @param $event
     * @return array
     */
    public function transform($event) : array
    {
        /* @var Event $event */
        return [
            'id'      => $event->getId(),
            'type'    => $event->getType(),
            'place'   => (new PlaceTransformer())->transform($event->getPlace()),
            'posts'   => (new PostCollectionTransformer())->transform($event->getPosts())
        ];
    }
}