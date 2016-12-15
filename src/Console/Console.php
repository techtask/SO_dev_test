<?php

namespace silverorange\DevTest\Console;

class Console
{
    public static function isConsole()
    {
        return (php_sapi_name() === 'cli');
    }

    public static function getConsoleArguments()
    {
        array_shift($argv);
        return $argv;
    }
}
