<?php

namespace silverorange\DevTest\View;

class ViewFactory implements ViewFactoryInterface
{
    abstract public function create($name);
}
