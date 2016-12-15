<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Console\Console;

class FrontController
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        if (Console::isConsole() !== true) {
            // Normally we would have a request/response object that we send along, but omitted here for simplicity.
            $view = $this->router->route($_SERVER['REQUEST_URI']);
            // At this point we would send a response object, but I am cheating and will just send headers and body.
            $this->sendHeaders();
        }
        else {
            // Set a custom route for the CLI tool.
            // Note this is a dummy path. Could create a separate tool, or do proper argument parsing on CLI etc. FIXME
            $path = "/";
            $view = $this->router->route($path);
        }
        echo $view->render();
    }

    public function sendHeaders()
    {
        // Custom headers go here.
    }

    private function parseCommandLineArguments()
    {
        return array();
    }
}
