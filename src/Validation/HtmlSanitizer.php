<?php

namespace silverorange\DevTest\Validation;

class HtmlSanitizer implements SanitizerInterface
{

    /**
     * sanitize
     *
     * This is not complete. Should really use something like htmlpurifier.
     *
     */

    public function sanitize($string)
    {
        return htmlentities($string);
    }
}
