<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Control\Route;

class RouteFactory
{
    public function createRoute($route, $arguments)
    {
        return new Route($route, $arguments);
    }
}
