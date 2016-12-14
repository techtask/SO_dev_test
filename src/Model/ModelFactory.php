<?php

namespace silverorange\DevTest\Model;

class ModelFactory implements ModelFactoryInterface
{
    protected $dal;

    public function __construct(DatabaseAccessInterface $dal)
    {
        $this->dal = $dal;
    }
}
