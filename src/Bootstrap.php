<?php

namespace silverorange\DevTest;

require __DIR__ . "/../vendor/autoload.php";

class Bootstrap
{

  /**
   * Initialize the application. Dependency injection done here.
   *
   */
  public function init()
  {
      $databaseUser = 'me';
      $paths = array(
          "default" => "PostController",
          "post" => "PostController",
          "author" => "AuthorController"
      );

      $config = new Config($databaseUser, $paths);
    
      // Database
      $db = new Database\DB($config->getDSN());
      $authorCRUD = new Database\AuthorCRUD($db);
      $postCRUD = new Database\PostCRUD($db);

      // Models
      $postModelFactory = new Model\PostModelFactory($postCRUD);
      $authorModelFactory = new Model\AuthorModelFactory($authorCRUD);
      // This is a hack, should really be done dynamically, but left this way for simplicity.
      $modelFactories = array(
       "post" => $postModelFactory,
       "author" => $authorModelFactory,
      );

      // Views
      $postViewFactory = new View\PostViewFactory();
      $authorViewFactory = new View\authorViewFactory();
      // This is a hack, should really be done dynamically, but left this way for simplicity.
      $ViewFactories = array(
        "post" => $postViewFactory,
        "author" => $authorViewFactory,
      );
    
      // Routing
      $routeFactory = new Control\RouteFactory();
      $urlParser = new Control\UrlParser($routeFactory);
      $controllerFactory = new Control\ControllerFactory($config->getPaths(), $config->getDefaultPath(), $modelFactories, $viewFactories);
      $router = new Control\Router($urlParser, $controllerFactory, $config->getDefaultPath());

      $app = new Control\FrontController($router);
      $app->run();
  }
}
