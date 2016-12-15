<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Model\ModelFactory;
use silverorange\DevTest\Exceptions\CreateModelException;

class PostModelFactory extends ModelFactory
{
    public function create($id, $title, $body, $modified_at, $created_at, $author)
    {
        try {
            $model = new \silverorange\DevTest\Model\Post($this->dal, $id, $title, $body, $modified_at, $created_at, $author);
        }
        catch (\Exception $e) {
            throw new CreateModelException("Error creating post with id $id:" .  $e->getMessage());
        }
        return $model;
    }
}
