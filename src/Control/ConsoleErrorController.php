<?php

namespace silverorange\DevTest\Control;

class ConsoleErrorController extends AbstractController
{
    public function runAction()
    {
        if (isset($this->arguments["error"])) {
            $error = $this->arguments["error"];
        } else {
            $error = "";
        }
        $this->displayHelp($error);
    }

    private function displayHelp($error)
    {
        $view = $this->viewFactory->create("ConsoleErrorView");
        $view->setError($error);
        return $view;
    }
}
