<?php

namespace silverorange\DevTest\Validation;

class CommandValidator
{
    protected $commandList;

    public function __construct(Array $commandList)
    {
        $this->commandList = $commandList;
    }

    public function validate($command)
    {
        if (in_array($this->commandList, $command)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function normalize($command)
    {
        return trim($command);
    }
}
