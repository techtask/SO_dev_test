<?php

namespace silverorange\DevTest\View;

use silverorange\DevTest\Validation\SanitizerInterface;

class ViewFactory implements ViewFactoryInterface
{
    public function __construct(SanitizerInterface $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

    public function create($name)
    {
        $class = '\silverorange\DevTest\View\\' . $name;
        try {
            $view = new $class();
            $view->setSanitizer($this->sanitizer);
        } catch (\Exception $e) {
            throw new InvalidViewException("No such view.");
        }
        return $view;
    }
}
