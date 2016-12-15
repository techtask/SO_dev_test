<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Exceptions\InvalidModelTypeException;
use silverorange\DevTest\Model\Author;

class AuthorModelArray
{
    public function __construct(array $authors)
    {
        foreach ($authors as $author) {
            if ($author instanceof Author) {
                $this->models = $authors;
            } else {
                throw new InvalidModelTypeExeption("Models must be authors to fit in this array.");
            }
        }
    }
}
