<?php

namespace silverorange\DevTest\View;

class ViewFactory
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
