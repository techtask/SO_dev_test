<?php

namespace silverorange\DevTest\Validation;

class CommandValidator
{
    protected $commandList;

    public function __construct(array $commandList)
    {
        $this->commandList = $commandList;
    }

    public function validate($command)
    {
        // FIXME This is not great

        if (isset($this->commandList[$command])) {
            return true;
        } else {
            return false;
        }
    }

    public function normalize($command)
    {
        return trim($command);
    }
}
