<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Validation\CommandValidator;
use silverorange\DevTest\Control\RouteFactory;
use silverorange\DevTest\Exceptions\InvalidMethodException;

class CommandParser implements RouteParserInterface
{

    protected $routeFactory;
    protected $commandValidator;
    protected $arguments = array();

    public function __contstruct(RouteFactory $routeFactory, CommandValidator $commandValidator, Array $arguments)
    {
        $this->routeFactory = $routeFactory;
        $this->commandValidator = $commandValidator;
        $this->arguments = $arguments;
    }

    public function parseRoute($command = null)
    {
        $command = $this->arguments[0];
        $url = $this->CommandValidator->normalize($command);

        if ($this->CommandValidator->validate($command) !== true) {
            throw new InvalidCommandException("Unknown command $command.");
        }
        else {
            $route = $this->commandList[$command];
        }

        return $this->RouteFactory->createRoute($route, $this->arguments);
    }
}
