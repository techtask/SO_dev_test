<?php

namespace silverorange\DevTest\Control;

class ConsoleImportController extends AbstractController
{
    public function runAction()
    {
        $data = $this->import();
        return $this->displayResults($data);
    }

    private function displayResults($data)
    {
        if ($data["error"] === true) {
            $view = $this->viewFactory->create("ConsoleErrorView");
            $view->setError($data["errorMessage"]);
            return $view;
        } else {
            $view = $this->viewFactory->create("ConsoleImportView");
            $view->setData($data);
            return $view;
        }
    }

    private function import()
    {
        $data = array("error" => false);
        $importModel = $this->modelFactory->create();
        $data = $importModel->importPostsFromFiles($this->arguments);
        return $data;
    }
}
