<?php

namespace silverorange\DevTest\Control;

public class Route
{
  private $route;
  private $arguments;

  public function __construct($route, Array $arguments)
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
