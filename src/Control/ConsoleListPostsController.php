<?php

namespace silverorange\DevTest\Control;

class ConsoleListPostsController extends AbstractController
{
    public function runAction()
    {
        $posts = $this->getPosts();
        return $this->displayResults($posts);
    }

    private function displayResults($posts)
    {
        if (is_null($posts)) {
            $view = $this->viewFactory->create("ConsoleErrorView");
            $view->setError("Error fetching posts.");
            return $view;
        } else {
            $view = $this->viewFactory->create("HtmlListPostsView");
            $view->setPosts($posts);
            return $view;
        }
    }

    private function getPosts()
    {
        $data = array("error" => false);
        // This is somewhat backwards.
        $data = $this->modelFactory->dal->readAllWithAuthors();
        if ($data === false || is_null($data) ) {
            return null;
        }
        $posts = array();
        foreach ($data as $row) {
            $posts[] = $this->modelFactory->create($row['id'], $row['title'], $row['body'], $row['created_at'], $row['modified_at'], $row['author'], $row['full_name']);
        }
        return $posts;
    }
}
