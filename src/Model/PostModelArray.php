<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Exceptions\InvalidModelTypeException;
use silverorange\DevTest\Model\Post;

class PostModelArray
{
    public function __construct(array $posts)
    {
        foreach ($posts as $post) {
            if ($post instanceof Post) {
                $this->models = $posts;
            } else {
                throw new InvalidModelTypeExeption("Models must be posts to fit in this array.");
            }
        }
    }
}
