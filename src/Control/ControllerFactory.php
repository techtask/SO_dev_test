<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Control\Route;
use silverorange\DevTest\Validation\ArgumentValidator;

public class ControllerFactory
{

  protected $paths;
  protected $defaultPath;
  protected $modelFactories;
  protected $viewFactories;
  protected $argumentValidator;

  public function __construct(Array $paths, $defaultPath, Array $modelFactories, Array $viewFactories, ArgumentValidator $argumentValidator)
  {
    $this->paths = $paths;
    $this->defaultPath = $defaultPath;
    $this->modelFactories = $modelFactories;
    $this->viewFactories = $viewFactories;
    $this->argumentValidator = $argumentValidator;
  }

  public function createController(Route $route)
  {
    try {
      $class = '\silverorange\DevTest\Control\\' . $this->paths[$route->getRoute()];
      $controller = new $class($this->modelFactories[$route->getRoute()], $this->viewFactories[$route->getRoute()], $this->argumentValidator, $route->getArguments());
    }
    catch (\Exception $e)
    {
      $class = '\silverorange\DevTest\Control\\' . $this->defaultPath;
      $controller = new $class($this->modelFactories[$this->defaultPath], $this->viewFactories[$this->defaultPath], $this->argumentValidator, array());
    }

    return $controller;
  }
}
