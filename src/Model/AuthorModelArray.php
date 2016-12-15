<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Exceptions\InvalidModelTypeException;
use silverorange\DevTest\Model\Author;

class AuthorModelArray
{
    public function __construct(Array $authors)
    {
        foreach($authors as $author) {
            if ($author !instanceof Author) {
                throw new InvalidModelTypeExeption("Models must be authors to fit in this array.");
            }
        }
        $this->models = $authors;
    }
}
