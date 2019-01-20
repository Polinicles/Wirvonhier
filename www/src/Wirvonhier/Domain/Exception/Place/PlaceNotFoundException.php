<?php

namespace Wirvonhier\Domain\Exception\Place;

use Symfony\Component\HttpFoundation\Response;

class PlaceNotFoundException extends \Exception
{
    /**
     * PlaceNotFoundException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message = 'Place not found', $code = Response::HTTP_NOT_FOUND)
    {
        parent::__construct($message, $code);
    }
}