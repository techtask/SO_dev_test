<?php

namespace silverorange\DevTest\View;

use silverorange\DevTest\Model\ModelArray;
use silverorange\DevTest\Validation\SanitizerInterface;

class View implements ViewInterface
{
    protected $models;
    protected $template;
    protected $sanitizer;

    public function setModels(ModelArray $models)
    {
        $this->models = $models;
    }

    public function setSanitizer(SanitizerInterface $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

    public function render()
    {
        ob_start();
        try {
            include($this->template . '.tpl');
        }
        catch (\Exception $e) {
            ob_get_clean();
            // FIXME
            die("Render Error.");
        }
        return ob_get_clean();
    }
}
