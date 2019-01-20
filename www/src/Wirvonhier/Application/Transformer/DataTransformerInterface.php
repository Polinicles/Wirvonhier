<?php

namespace Wirvonhier\Application\Transformer;

interface DataTransformerInterface
{
    /**
     * @param $data
     * @return array
     */
    public function transform($data) : array;
}