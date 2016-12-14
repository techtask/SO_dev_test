<?php

namespace silverorange\DevTest\Control;

class Route
{
    private $route;
    private $arguments;

    public function __construct($route, array $arguments)
    {
        $this-$route = $route;
        $this->$arguments = $arguments;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getArguments()
    {
        return $this->arguments;
    }
}
