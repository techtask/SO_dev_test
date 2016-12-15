<?php

namespace silverorange\DevTest\View;

use silverorange\DevTest\Validation\HtmlSanitizer;

class HtmlView extends View
{
    public function __construct(HtmlSanitizer $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }
}
