<?php

namespace Wirvonhier\Domain\Exception\Event;

use Symfony\Component\HttpFoundation\Response;

class EventNotFoundException extends \Exception
{
    /**
     * EventNotFoundException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message = 'Event not found', $code = Response::HTTP_NOT_FOUND)
    {
        parent::__construct($message, $code);
    }
}