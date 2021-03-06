<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Model\ModelFactoryInterface;
use silverorange\DevTest\View\ViewFactoryInterface;
use silverorange\DevTest\Validation\ArgumentValidator;

abstract class AbstractController
{
    protected $arguments;
    protected $modelFactory;
    protected $viewFactory;
    protected $argumentValidator;

    public function __construct(ModelFactoryInterface $modelFactory, ViewFactoryInterface $viewFactory, ArgumentValidator $argumentValidator, array $arguments)
    {
        $this->modelFactory = $modelFactory;
        $this->viewFactory = $viewFactory;
        $this->argumentValidator = $argumentValidator;
        $this->arguments = $arguments;
    }

    abstract public function runAction();
}
