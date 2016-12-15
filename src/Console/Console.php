<?php

namespace silverorange\DevTest\Console;

class Console
{
    private $arguments;

    public function __construct($arguments)
    {
        if (!is_array($arguments)) {
            $arguments = array();
        } else {
            array_shift($arguments);
        }
        $this->arguments = $arguments;
    }

    public static function isConsole()
    {
        return (php_sapi_name() === 'cli');
    }

    public function getConsoleArguments()
    {
        return $this->arguments;
    }
}
