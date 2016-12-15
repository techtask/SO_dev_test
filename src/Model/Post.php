<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Database\DatabaseAccessInterface;
use silverorange\DevTest\Exceptions\NoSuchRecordException;
use silverorange\DevTest\Exceptions\CreateModelException;
use silverorange\DevTest\Exceptions\DeleteModelException;

class Post extends AbstractModel
{
    public $id;
    public $title;
    public $body;
    public $created_at;
    public $modified_at;
    public $author;

    public function __construct(DatabaseAccessInterface $dal, $id, $title, $body, $created_at, $modified_at, $author)
    {
        parent::__construct($dal);
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->created_at = $created_at;
        $this->modified_at = $modified_at;
        $this->author = $author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function update()
    {
        try {
            $data = $this->dal->read($this->id);
        } catch (NoSuchRecordException $e) {
            return false;
        }

        if (is_null($data)) {
            return false;
        }

        // FIXME Should use getters/setters for encapsulation.

        print_r($data);
        $this->title = $data['title'];
        $this->body = $data['body'];
        $this->created_at = $data['created_at'];
        $this->modified_at = $data['modified_at'];
        $this->author = $data['author'];

        return true;
    }

    public function save()
    {
        try {
            $this->dal->update($this->id, $this->title, $this->body, $this->created_at, $this->modified_at, $this->author);
        } catch (NoSuchRecordException $e) {
            try {
                $this->dal->create($this->id, $this->title, $this->body, $this->created_at, $this->modified_at, $this->author);
            } catch (\Exception $e) {
                throw new InsertModelException("Error creating post with id: " . $this->id . ": " . $e->getMessage());
            }
        }
    }

    public function destroy()
    {
        try {
            $this->dal->delete($this->id);
        } catch (NoSuchRecordException $e) {
            ;
            ;
        } catch (\Exception $e) {
            throw new DeleteModelException("Error deleting post with id: " . $this->id . ": " . $e->getMessage());
        }
    }
}
