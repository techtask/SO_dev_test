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
      // FIXME This should be elsewhere. Maybe json.
      $databaseUser = 'me';
      $paths = array(
          "default" => "PostController",
          "post" => "PostController",
          "author" => "AuthorController",
      );

      $commandList = array(
          "import" => "post"
      );

      $config = new Config($databaseUser, $paths, $commandList);
    
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
      $commandValidator = new Validation\CommandValidator($config->getCommandList());
      $urlValidator = new Validation\UrlValidator();
      $controllerFactory = new Control\ControllerFactory($config->getPaths(), $config->getDefaultPath(), $modelFactories, $viewFactories);
      if (Console::isConsole()) {
        $parser = new Control\CommandParser($routeFactory, $commandValidator, Console::getConsoleArguments());
      } else {
        $parser = new Control\UrlParser($routeFactory, $urlValidator);
      }

      $router = new Control\Router($parser, $controllerFactory, $routeFactory->create($config->getDefaultPath(), array()));

      $app = new Control\FrontController($router);
      $app->run();
  }

}
