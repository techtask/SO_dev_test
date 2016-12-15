<?php

namespace silverorange\DevTest\View;

class ConsoleImportView extends ConsoleView
{

    public $template = "ConsoleImport";
    public $data = array();

    public function setData(Array $data)
    {
        $this->data = $data;
    }
}
