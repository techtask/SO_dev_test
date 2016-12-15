<?php

namespace silverorange\DevTest\View;

class ConsoleErrorView extends ConsoleView
{

    private $error = "";
    protected $template = "ConsoleError";

    public function setError($error)
    {
        $this->error = $error;
    }
}
