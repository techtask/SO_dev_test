<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Database\DatabaseAccessInterface;
use silverorange\DevTest\Exceptions\NoSuchRecordException;
use silverorange\DevTest\Exceptions\CreateModelException;
use silverorange\DevTest\Exceptions\DeleteModelException;

class PostWithAuthor extends AbstractModel
{
    public $id;
    public $title;
    public $body;
    public $created_at;
    public $modified_at;
    public $author;
    public $authorName;

    public function __construct(DatabaseAccessInterface $dal, $id, $title, $body, $created_at, $modified_at, $author, $authorName)
    {
        parent::__construct($dal);
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->created_at = $created_at;
        $this->modified_at = $modified_at;
        $this->author = $author;
        $this->authorName = $authorName;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function save()
    {
    }

    public function update()
    {
        try {
            $data = $this->dal->readWithAuthor($this->id);
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
        $this->authorName = $data['full_name'];

        return true;
    }

    public function destroy()
    {
    }
}
