<?php

namespace silverorange\DevTest\Validation;

/**
 * This should be separated into specific classes for specific arguments. Left this way for simplicity.
 * Also should use separate validation library. Included only for completion!
 *
 */
class ArgumentValidator
{
    public function parseInt($var)
    {
        return (int)$var;
    }

    public function isInt($var)
    {
        return is_int($var);
    }
}
