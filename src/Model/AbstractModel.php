<?php

namespace silverorange\DevTest\Model;

abstract class AbstractModel
{
    public $dal;

    public function __construct(DatabaseAccessInterface $dal)
    {
        $this->dal = $dal;
    }

    abstract public function save();
}
