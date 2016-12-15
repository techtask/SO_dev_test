<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Validation\CommandValidator;
use silverorange\DevTest\Control\RouteFactory;
use silverorange\DevTest\Exceptions\InvalidMethodException;
use silverorange\DevTest\Control\RouteParserInterface;

class CommandParser implements RouteParserInterface
{

    protected $routeFactory;
    protected $commandValidator;
    protected $arguments = array();
    protected $commandList = array();

    public function __contstruct(RouteFactory $routeFactory, CommandValidator $commandValidator, Array $arguments, Array $commandList)
    {
        $this->routeFactory = $routeFactory;
        $this->commandValidator = $commandValidator;
        $this->arguments = $arguments;
        $this->commandList = $commandList;
    }

    public function parseRoute($command = null)
    {
        try {
            $command = $this->arguments[0];
            $command = $this->commandValidator->normalize($command);
        }
        catch (\Exception $e)
        {
            throw new InvalidCommandException("Invalid command specified. Try \"help\".");
        }

        if ($this->CommandValidator->validate($command) !== true) {
            throw new InvalidCommandException("Unknown command $command.");
        }
        else {
            $route = $this->commandList[$command];
        }

        return $this->RouteFactory->createRoute($route, $this->arguments);
    }
}
