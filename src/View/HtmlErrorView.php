<?php

namespace silverorange\DevTest\View;

class HtmlErrorView extends HtmlView
{

    private $error = "";
    private $template = "HtmlError";

    public function setError($error)
    {
        $this->error = $error;
    }
}
