<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Control\UrlParser;
use silverorange\DevTest\Control\ControllerFactory;
use silverorange\DevTest\Control\Route;
use silverorange\DevTest\Exceptions\InvalidRouteException;

class Router
{
    protected $parser;
    protected $controllerFactory;
    protected $defaultRoute;

    public function __construct(UrlParser $parser, ControllerFactory $controllerFactory, $defaultRoute)
    {
        $this->parser = $parser;
        $this->controllerFactory = $controllerFactory;
        $this->defaultRoute = $defaultRoute;
    }

    public function route($url)
    {
        try {
            $route = $this->parser->parseRoute($url);
        } catch (\Exception $e) {
            // No route found, send to default.
      // Note this is really validated twice since it is also done in controllerFactory.
      $route = $this->defaultRoute();
        }

        try {
            $controller = $this->controllerFactory->createController($route);
            $controller->runAction();
        } catch (\Exception $e) {
            // Invalid Route specified, handle this above.
      throw new InvalidRouteException("Invalid route or arguments specified.");
        }
    }
}
