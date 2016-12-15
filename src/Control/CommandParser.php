<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Validation\CommandValidator;
use silverorange\DevTest\Control\RouteFactory;
use silverorange\DevTest\Control\RouteParserInterface;
use silverorange\DevTest\Exceptions\InvalidCommandException;

class CommandParser implements RouteParserInterface
{

    protected $routeFactory;
    protected $commandValidator;
    protected $arguments = array();
    protected $commandList = array();

    public function __construct(RouteFactory $routeFactory, CommandValidator $commandValidator, Array $arguments, Array $commandList)
    {
        $this->routeFactory = $routeFactory;
        $this->commandValidator = $commandValidator;
        $this->arguments = $arguments;
        $this->commandList = $commandList;
    }

    public function parseRoute($command = null)
    {
        try {
            if (!empty($this->arguments)) {
                $command = $this->arguments[0];
            } else {
                $command = null;
            }
            $command = $this->commandValidator->normalize($command);
        }
        catch (\Exception $e)
        {
            throw new InvalidCommandException("Invalid command specified. Try \"help\".");
        }

        if ($this->commandValidator->validate($command) !== true) {
            throw new InvalidCommandException("Unknown command $command.");
        }
        else {
            $route = $this->commandList[$command];
        }

        return $this->RouteFactory->createRoute($route, $this->arguments);
    }
}
