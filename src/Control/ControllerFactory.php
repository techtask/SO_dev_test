<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Control\Route;
use silverorange\DevTest\Validation\ArgumentValidator;
use silverorange\DevTest\Console\Console;
use silverorange\DevTest\View\ViewFactory;

class ControllerFactory
{
    protected $paths;
    protected $defaultPath;
    protected $modelFactories;
    protected $viewFactory;
    protected $argumentValidator;
    protected $commandList;

    public function __construct(Array $paths, $defaultPath, Array $modelFactories, ViewFactory $viewFactory, ArgumentValidator $argumentValidator, Array $commandList)
    {
        $this->paths = $paths;
        $this->defaultPath = $defaultPath;
        $this->modelFactories = $modelFactories;
        $this->viewFactory = $viewFactory;
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
            $controller = new $class($this->modelFactories[$route->getRoute()], $this->viewFactory, $this->argumentValidator, $route->getArguments());
        } catch (\Exception $e) {
            if (Console::isConsole() !== true) {
                $class = '\silverorange\DevTest\Control\\' . $this->paths[$this->defaultPath];
                $controller = new $class($this->modelFactories[$this->paths[$this->defaultPath]], $this->viewFactory, $this->argumentValidator, array());
            } else {
                $class = '\silverorange\DevTest\Control\\' . $this->commandList[$this->defaultPath];
                $controller = new $class($this->modelFactories[$this->commandList[$this->defaultPath]], $this->viewFactory, $this->argumentValidator, array());
            }
        }

        return $controller;
    }
}
