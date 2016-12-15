<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Model\ModelFactory;
use silverorange\DevTest\Exceptions\CreateModelException;

class PostWithAuthorModelFactory extends ModelFactory
{
    public function create($id, $title, $body, $modified_at, $created_at, $author, $authorName)
    {
        try {
            $model = new \silverorange\DevTest\Model\PostWithAuthor($this->dal, $id, $title, $body, $modified_at, $created_at, $author, $authorName);
        } catch (\Exception $e) {
            throw new CreateModelException("Error creating post with id $id:" .  $e->getMessage());
        }
        return $model;
    }
}
