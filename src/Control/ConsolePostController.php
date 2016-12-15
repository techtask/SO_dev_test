<?php

namespace silverorange\DevTest\Control;

class ConsolePostController extends AbstractController
{
    public function runAction()
    {
        $post = $this->getPost($this->arguments[0]);
        return $this->displayResults($post, $this->arguments[0]);
    }

    private function displayResults($post, $id)
    {
        if (is_null($post)) {
            $view = $this->viewFactory->create("ConsoleErrorView");
            $view->setError("No post with id $id.");
            return $view;
        } else {
            $view = $this->viewFactory->create("HtmlPostView");
            $view->setPost($post);
            return $view;
        }
    }

    private function getPost($id)
    {
        $data = array("error" => false);
        $postModel = $this->modelFactory->create($id, null, null, null, null, null);
        $result = $postModel->update();
        if ($result === true) {
            return $postModel;
        } else {
            return null;
        }
    }
}
