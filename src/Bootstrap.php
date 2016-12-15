<?php

namespace silverorange\DevTest;

require __DIR__ . "/../vendor/autoload.php";

class Bootstrap
{

  /**
   * Initialize the application. Dependency injection done here.
   *
   */
  public function init($arguments = null)
  {
      // FIXME This should be elsewhere. Maybe json.
      $databaseUser = 'me';
      $paths = array(
          "default" => "PostController",
          "post" => "PostController",
          "author" => "AuthorController",
          "error" => "ErrorController"
      );

      $commandList = array(
          "default" => "ConsoleErrorController",
          "import" => "ConsoleImportController",
          "error" => "ConsoleErrorController",
          "help" => "ConsoleErrorController",
      );

      $config = new Config($databaseUser, $paths, $commandList, "default");
      $console = new Console\Console($arguments);
    
      // Database
      $db = new Database\DB($config->getDSN());
      $authorCRUD = new Database\AuthorCRUD($db);
      $postCRUD = new Database\PostCRUD($db);

      // Models
      $postModelFactory = new Model\PostModelFactory($postCRUD);
      $authorModelFactory = new Model\AuthorModelFactory($authorCRUD);
      // This is a hack, should really be done dynamically, but left this way for simplicity.
      $modelFactories = array(
        "default" => $postModelFactory, // FIXME This only works because the default console controller doesn't use it.
        "post" => $postModelFactory,
        "author" => $authorModelFactory,
        "import" => $postModelFactory,
        "error" => $postModelFactory, // FIXME same here
        "help" => $postModelFactory // FIXME same issue.
      );

      // Views
      $viewFactory = new View\ViewFactory();
    
      // Routing
      $routeFactory = new Control\RouteFactory();
      $commandValidator = new Validation\CommandValidator($config->getCommandList());
      $urlValidator = new Validation\UrlValidator();
      $argumentValidator = new Validation\ArgumentValidator();
      $controllerFactory = new Control\ControllerFactory($config->getPaths(), $config->getDefaultPath(), $modelFactories, $viewFactory, $argumentValidator, $config->getCommandList());

      if (Console\Console::isConsole()) {
        $parser = new Control\CommandParser($routeFactory, $commandValidator, $console->getConsoleArguments(), $config->getCommandList());
      } else {
        $parser = new Control\UrlParser($routeFactory, $urlValidator);
      }

      $router = new Control\Router($parser, $controllerFactory, $routeFactory->createRoute($config->getDefaultPath(), array()));

      $app = new Control\FrontController($router);
      $app->run();
  }

}
