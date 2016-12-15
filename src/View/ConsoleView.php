<?php

namespace silverorange\DevTest\View;

use silverorange\DevTest\Validation\ConsoleSanitizer;

class ConsoleView extends View
{
    public function __construct(ConsoleSanitizer $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }
}
