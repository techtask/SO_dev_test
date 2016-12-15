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
        // FIXME This is not great

        if (in_array($command, $this->commandList)) {
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
