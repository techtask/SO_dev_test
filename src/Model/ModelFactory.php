<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Model\ModelFactoryInterface;
use silverorange\DevTest\Database\DatabaseAccessInterface;

class ModelFactory implements ModelFactoryInterface
{
    protected $dal;

    public function __construct(DatabaseAccessInterface $dal)
    {
        $this->dal = $dal;
    }
}
