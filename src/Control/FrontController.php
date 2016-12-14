<?php

namespace silverorange\DevTest\Control;

public class FrontController
{
  public function __construct(AuthorCRUD $authorCRUD, PostCRUD $postCRUD, Router $router, $method)
  {
    $this->authorCRUD = $authorCRUD;
    $this->postCRUD = $postCRUD;
    $this->router = $router;
    $this->method = $method;
  }

  public function run()
  {
    $this->router->route($_SERVER['REQUEST_URI']);
  }
}
