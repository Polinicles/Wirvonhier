<?php

namespace Wirvonhier\Domain\Exception\Validation;

use Symfony\Component\HttpFoundation\Response;

class InvalidParamTypeException extends \Exception
{

    /**
     * InvalidParamTypeException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message = 'Invalid parameter type', $code = Response::HTTP_BAD_REQUEST)
    {
        parent::__construct($message, $code);
    }
}