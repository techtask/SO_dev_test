<?php

namespace silverorange\DevTest\View;

public class AuthorViewFactory
{
  public function create($name)
  {
    $class = '\silverorange\DevTest\View\\' . $name;
    try {
      $view = new $class();
    }
    catch (\Exception $e) {
      throw new \Exception InvalidViewException("No such view.");
    }
  }
}
