<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Control\Route;
use silverorange\DevTest\Validation\ArgumentValidator;

class ControllerFactory
{
    protected $paths;
    protected $defaultPath;
    protected $modelFactories;
    protected $viewFactories;
    protected $argumentValidator;
    protected $commandList;

    public function __construct(Array $paths, $defaultPath, Array $modelFactories, Array $viewFactories, ArgumentValidator $argumentValidator, Array $commandList)
    {
        $this->paths = $paths;
        $this->defaultPath = $defaultPath;
        $this->modelFactories = $modelFactories;
        $this->viewFactories = $viewFactories;
        $this->argumentValidator = $argumentValidator;
        $this->commandList = $commandList;
    }

    public function createController(Route $route)
    {
        try {
            if (Console::isConsole() !== true) {
                $class = '\silverorange\DevTest\Control\\' . $this->paths[$route->getRoute()];
            } else {
                $class = '\silverorange\DevTest\Control\\' . $this->commandList[$route->getRoute()];
            }
            $controller = new $class($this->modelFactories[$route->getRoute()], $this->viewFactories[$route->getRoute()], $this->argumentValidator, $route->getArguments());
        } catch (\Exception $e) {
            if (Console::isConsole() !== true) {
                $class = '\silverorange\DevTest\Control\\' . $this->paths[$this->defaultPath];
                $controller = new $class($this->modelFactories[$this->paths[$this->defaultPath]], $this->viewFactories[$this->paths[$this->defaultPath]], $this->argumentValidator, array());
            } else {
                $class = '\silverorange\DevTest\Control\\' . $this->commandList[$this->defaultPath];
                $controller = new $class($this->modelFactories[$this->commandList[$this->defaultPath]], $this->viewFactories[$this->commandList[$this->defaultPath]], $this->argumentValidator, array());
            }
        }

        return $controller;
    }
}
