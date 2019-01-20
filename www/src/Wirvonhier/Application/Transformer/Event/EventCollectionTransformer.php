<?php

namespace Wirvonhier\Application\Transformer\Event;

use Wirvonhier\Application\Transformer\DataTransformerInterface;

class EventCollectionTransformer implements DataTransformerInterface
{

    /**
     * @param $events
     * @return array
     */
    public function transform($events): array
    {
        $result = [];

        foreach ($events as $event) {
            array_push($result, (new EventTransformer())->transform($event));
        }

        return $result;
    }
}