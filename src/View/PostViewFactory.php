<?php

namespace silverorange\DevTest\View;

use \silverorange\DevTest\Exceptions\InvalidViewException;

class PostViewFactory
{
    public function create($name)
    {
        $class = '\silverorange\DevTest\View\\' . $name;
        try {
            $view = new $class();
        } catch (\Exception $e) {
            throw new InvalidViewException("No such view.");
        }
        return $view;
    }
}
