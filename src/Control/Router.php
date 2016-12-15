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

    public function __construct(RouteParserInterface $parser, ControllerFactory $controllerFactory, Route $defaultRoute)
    {
        $this->parser = $parser;
        $this->controllerFactory = $controllerFactory;
        $this->defaultRoute = $defaultRoute;
    }

    public function route($route)
    {
        try {
            $route = $this->parser->parseRoute($route);
        } catch (InvalidUrlException $e) {
            // No route found, send to error.
            // Note this is really validated twice since it is also done in controllerFactory.

            $route = $this->defaultRoute;
            $route->setArgument("error", "Invalid path specified => " . $e->getMessage());
        } catch (InvalidRequestMethodException $e) {
            $route = $this->defaultRoute;
            $route->setArgument("error", "Invalid http method specified => " . $e->getMessage());
        } catch (InvalidCommandException $e) {
            $route = $this->defaultRoute;
            $route->setArgument("error", "Invalid command specified => " . $e->getMessage());
        } catch (\Exception $e) {
            $route = $this->defaultRoute;
            $route->setArgument("error", "Unknown Error => " . $e->getMessage());
        }

        $result = "";
        try {
            $controller = $this->controllerFactory->createController($route);
            $result = $controller->runAction();
        } catch (\Exception $e) {
            // Invalid Route specified, handle this above.
            throw new InvalidRouteException("Invalid route or arguments specified.");
        }

        return $result;
    }
}
