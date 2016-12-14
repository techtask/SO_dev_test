<?php

namespace silverorange\DevTest\Control;

public class PostController extends AbstractController
{

  public function runAction()
  {
    try {
    $this->displayPost();
    }
    catch (\Exception $e) {
      $this->displayDefault();
    }
  }

  private function displayPost()
  {
    // Do validation of arguments here.
    $id = $this->ArgumentValidator->parseInt($this->arguments[0]);
    if ($this->ArgumentValidator->isInt($id) === false) {
      throw new InvalidArgumentException
    };
    $post = $this->modelFactory->create($id);
    $view = $this->viewFactory->create("singlePost");
    $view->setModel($post);
    $view->render();
  }

  private function displayDefault()
  {
    // Ignore arguments and display error.
    $view = $this->viewFactory->create("error");
    $view->setError("No such post");
    $view->render();
  }
}
