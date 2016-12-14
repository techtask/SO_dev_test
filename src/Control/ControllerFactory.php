<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Control\Route;

public class ControllerFactory
{

  public function __construct(Array $paths, $defaultPath)
  {
    $this->paths = $paths;
    $this->defaultPath = $defaultPath;
  }

  public function createController(Route $route)
  {
    try {
      $class = '\silverorange\DevTest\Control\\' . $this->paths[$route->getRoute()];
      $controller = new $class();
    }
    catch (\Exception $e)
    {
      $class = '\silverorange\DevTest\Control\\' . $this->paths[$this->defaultPath];
      $controller = new $class();
    }

    return $controller;
  }
}
