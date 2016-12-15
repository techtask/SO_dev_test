<?php

namespace silverorange\DevTest\Validation;

class ImportPostValidator
{
    /**
     * This is for generic validation. For individual parameter validation see below.
     * Note that we leave author id validation to the database query.
     *
     */

    public function validatePostJSON($json)
    {
        // Check if each value is set.
        
        $vars = array("id", "title", "body", "modified_at", "created_at", "author"); 

        foreach ($vars as $var) {
            if (!isset($json[$var])) {
                return false;
            }
        }

        // Check types and required fields. Making some assumptions here. Null fields can be emptystring.

        $vars = array("id", "title", "modified_at", "created_at", "author"); 
        foreach ($vars as $var) {
            if (empty($json[$var])) {
                return false;
            }
        }

        $vars = array("modified_at", "created_at"); 
        foreach ($vars as $var) {
            if ($this->validateDateString($json[$var]) !== true) {
                return false;
            }
        }

        return true;
    }

    /**
     * This is not at all foolproof. More checking is needed.
     *
     */

    private function validateDateString($string)
    {
        $result = strtotime($string);
        if ($result !== false) {
            return true;
        }
        return false;
    }
}
