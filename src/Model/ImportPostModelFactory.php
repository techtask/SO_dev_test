<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Model\ModelFactory;
use silverorange\DevTest\Database\PostCRUD;
use silverorange\DevTest\Validation\ImportPostValidator;

class ImportPostModelFactory extends ModelFactory
{
    public $modelFactory;
    public $validator;

    public function __construct(PostCRUD $dal, PostModelFactory $modelFactory, ImportPostValidator $validator)
    {
        parent::__construct($dal);
        $this->modelFactory = $modelFactory;
        $this->validator = $validator;
    }

    public function create()
    {
        try {
            $model = new \silverorange\DevTest\Model\ImportPostModel($this->modelFactory, $this->validator);
        } catch (\Exception $e) {
            // FIXME This should not happen. Delegate.
            throw $e;
        }
        return $model;
    }
}
