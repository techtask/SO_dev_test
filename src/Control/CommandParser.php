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

    public function __construct(RouteFactory $routeFactory, CommandValidator $commandValidator, array $arguments, array $commandList)
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
                throw InvalidCommandException("");
            }
            $command = $this->commandValidator->normalize($command);
        } catch (\Exception $e) {
            throw new InvalidCommandException("Invalid command specified. Try \"help\".");
        }

        if ($this->commandValidator->validate($command) !== true) {
            throw new InvalidCommandException("Unknown command $command.");
        } else {
            $route = $command;
            array_shift($this->arguments); // No need for main command in arguments after setting it.
        }

        return $this->routeFactory->createRoute($route, $this->arguments);
    }
}
