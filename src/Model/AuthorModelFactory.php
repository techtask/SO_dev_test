<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Model\ModelFactory;
use silverorange\DevTest\Exceptions\CreateModelException;

class AuthorModelFactory extends ModelFactory
{
    public function create($id, $name, $created_at, $modified_at)
    {
        try {
            $model = new \silverorange\DevTest\Model\Author($this->dal, $id, $name, $created_at, $modified_at);
        } catch (\Exception $e) {
            throw new CreateModelException("Error creating author with id $id:" .  $e->getMessage());
        }
        return $model;
    }
}
