<?php

namespace silverorange\DevTest\View;

public class ViewFactory implements ViewFactoryInterface
{
  abstract public function create($name);
}
