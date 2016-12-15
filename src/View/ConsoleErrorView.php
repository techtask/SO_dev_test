<?php

namespace silverorange\DevTest\View;

class ConsoleErrorView extends ConsoleView
{
    public $error = "";
    public $template = "ConsoleError";

    public function setError($error)
    {
        $this->error = $error;
    }
}
