<?php

namespace Wirvonhier\Application\Transformer\Post;

use Wirvonhier\Application\Transformer\DataTransformerInterface;
use Wirvonhier\Application\Transformer\User\UserTransformer;
use Wirvonhier\Domain\Entity\Post;

class PostTransformer implements DataTransformerInterface
{
    /**
     * @param $post
     * @return array
     */
    public function transform($post): array
    {
        /* @var Post $post */
        return [
            'id'        => $post->getId(),
            'author'    => (new UserTransformer())->transform($post->getAuthor())
        ];
    }
}