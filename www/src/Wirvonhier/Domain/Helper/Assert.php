<?php

namespace Wirvonhier\Domain\Helper;

use Wirvonhier\Domain\Exception\Validation\InvalidParamTypeException;

class Assert
{
    const COORDENATE_PRECISION  = 9;
    const COORDENATE_SCALE      = 6;

    /**
     * Check if param is a valid string
     *
     * @param $param
     * @param $paramName
     */
    public static function isString($param, $paramName)
    {
        if(!is_string($param)) {
            self::throwInvalidParamTypeException($paramName, 'string');
        }
    }

    /**
     * Check if param is a valid integer
     *
     * @param $param
     * @param $paramName
     */
    public static function isInt($param, $paramName)
    {
        if(!is_int($param)) {
            self::throwInvalidParamTypeException($paramName, 'integer');
        }
    }

    /**
     * Check if a coordenate has the right format (decimal(9,6))
     *
     * @param $coordenate
     * @param $coordenateType
     */
    public static function isValidCoordenate($coordenate, $coordenateType)
    {
        $isValid = false;
        if (is_numeric($coordenate)) {
            $num        = round(abs($coordenate), self::COORDENATE_SCALE);
            $max        = str_repeat((string) self::COORDENATE_PRECISION,self::COORDENATE_PRECISION - self::COORDENATE_SCALE). '.'.str_repeat((string) self::COORDENATE_PRECISION,self::COORDENATE_SCALE);
            $isValid    = $num <= $max;
        }

        if(!$isValid) {
            self::throwInvalidParamTypeException($coordenate, $coordenateType);
        }
    }

    /**
     * @param $paramName
     * @param $type
     * @throws InvalidParamTypeException
     */
    public static function throwInvalidParamTypeException($paramName, $type)
    {
        throw new InvalidParamTypeException('Parameter '.$paramName.' must be a '.$type);
    }
}