<?php

namespace Wirvonhier\Application\Transformer\Post;

use Wirvonhier\Application\Transformer\DataTransformerInterface;

class PostCollectionTransformer implements DataTransformerInterface
{
    /**
     * @param $posts
     * @return array
     */
    public function transform($posts): array
    {
        $result = [];

        foreach ($posts as $post) {
            array_push($result, (new PostTransformer())->transform($post));
        }

        return $result;
    }
}