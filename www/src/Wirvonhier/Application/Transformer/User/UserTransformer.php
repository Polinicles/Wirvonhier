<?php

namespace Wirvonhier\Application\Transformer\User;

use Wirvonhier\Application\Transformer\DataTransformerInterface;
use Wirvonhier\Domain\Entity\User;

class UserTransformer implements DataTransformerInterface
{
    /**
     * @param $user
     * @return array
     */
    public function transform($user): array
    {
        /* @var User $user */
        return [
            'id'        => $user->getId(),
            'emails'    => $user->getEmail()
        ];
    }
}