<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Database\DatabaseAccessInterface;

abstract class AbstractModel
{
    public $dal;

    public function __construct(DatabaseAccessInterface $dal)
    {
        $this->dal = $dal;
    }

    abstract public function save();

    abstract public function update();

    abstract public function destroy();
}
