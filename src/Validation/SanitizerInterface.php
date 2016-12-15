<?php

namespace silverorange\DevTest\Validation;

interface SanitizerInterface
{
    public function sanitize($string);
}
