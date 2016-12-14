<?php

namespace silverorange\DevTest\Control;

public class AbstractController
{
  protected $arguments; 
  protected $modelFactory;
  protected $viewFactory;
  protected $argumentValidator;

  public function __construct(ModelFactoryInterface $modelFactory, ViewFactoryInterface $viewFactory, ArgumentValidator $argumentValidator, Array $arguments)
  {
    $this->modelFactory = $modelFactory;
    $this->ViewFactory = $viewFactory;
    $this->argumentValidator = $argumentValidator;
    $this->arguments = $arguments;
  }

  abstract public function runAction();
}
