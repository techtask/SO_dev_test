<?php

namespace silverorange\DevTest;

public class Bootstrap
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

    // Routing
    $routeFactory = new Control\RouteFactory();
    $urlParser = new Control\UrlParser($routeFactory);
    $controllerFactory = new Control\ControllerFactory($config->getPaths(), $config->getDefaultPath());
    $router = new Control\Router($urlParser, $controllerFactory, $config->getDefaultPath());

    // Database
    $db = new Database\DB($config->getDSN());
    $authorCRUD = new Database\AuthorCRUD($db);
    $postCRUD = new Database\PostCRUD($db);

    $app = new Control\FrontController($authorCRUD, $postCRUD, $router);
    $app->run();

  }

}
