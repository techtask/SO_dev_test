<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Control\Route;

public class RouteFactory
{
  public function createRoute($route, $arguments)
  {
    return new Route($route, $arguments);
  }
}
