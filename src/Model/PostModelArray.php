<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Exceptions\InvalidModelTypeException;
use silverorange\DevTest\Model\Post;

class PostModelArray
{
    public function __construct(Array $posts)
    {
        foreach($posts as $post) {
            if ($post !instanceof Post) {
                throw new InvalidModelTypeExeption("Models must be posts to fit in this array.");
            }
        }
        $this->models = $posts;
    }
}
