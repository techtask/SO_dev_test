<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Database\DatabaseAccessInterface;
use silverorange\DevTest\Exceptions\NoSuchRecordException;
use silverorange\DevTest\Exceptions\InsertModelException;
use silverorange\DevTest\Exceptions\DeleteModelException;


class Author extends AbstractModel
{
    public $id;
    public $full_name;
    public $created_at;
    public $modified_at;

    public function __construct(DatabaseAccessInterface $dal, $id, $full_name, $created_at, $modified_at)
    {
        parent::__construct($dal);
        $this->id = $id;
        $this->full_name = $full_name;
        $this->created_at = $created_at;
        $this->modified_at = $modified_at;
    }

    public function save()
    {
        try {
            $this->dal->update($this->id, $this->full_name, $this->created_at, $this->modified_at);
        }
        catch (NoSuchRecordException $e) {
            try {
                $this->dal->create($this->id, $this->full_name, $this->created_at, $this->modified_at);
            }
            catch (\Exception $e) {
                throw new InsertModelException("Error creating author with id: " . $this->id . ": " . $e->getMessage());
            }
        }

    }

    public function destroy()
    {
        try {
            $this->dal->delete($this->id);
        }
        catch (NoSuchRecordException $e) {
            ;;
        }
        catch (\Exception $e)
        {
            throw new DeleteModelException("Error deleting author with id: " . $this->id . ": " . $e->getMessage());
        }
    }
}
