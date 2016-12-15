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
      $databaseUser = getenv('PG_USER');
      $databasePassword = getenv('PG_PASS');
      $paths = array(
          "default" => "ErrorController",
          "post" => "PostController",
          "author" => "AuthorController",
          "error" => "ErrorController"
      );

      $commandList = array(
          "default" => "ConsoleErrorController",
          "import-posts" => "ConsoleImportController",
          "show-post" => "ConsolePostController",
          "list-posts" => "ConsoleListPostsController",
          "error" => "ConsoleErrorController",
          "help" => "ConsoleErrorController",
      );

      $config = new Config($databaseUser, $databasePassword, $paths, $commandList, "default");
      $console = new Console\Console($arguments);
    
      // Database
      $db = new Database\DB($config->getDSN());
      $authorCRUD = new Database\AuthorCRUD($db);
      $postCRUD = new Database\PostCRUD($db);

      // Models
      $postValidator = new Validation\ImportPostValidator();
      $postModelFactory = new Model\PostModelFactory($postCRUD);
      $postWithAuthorModelFactory = new Model\PostWithAuthorModelFactory($postCRUD);
      $authorModelFactory = new Model\AuthorModelFactory($authorCRUD);
      $importPostModelFactory = new Model\ImportPostModelFactory($postCRUD, $postModelFactory, $postValidator);
      // This is a hack, should really be done dynamically, but left this way for simplicity.
      $modelFactories = array(
        "default" => $postModelFactory, // FIXME This only works because the default console controller doesn't use it.
        "post" => $postModelFactory,
        "author" => $authorModelFactory,
        "import-posts" => $importPostModelFactory,
        "show-post" => $postModelFactory,
        "list-posts" => $postWithAuthorModelFactory,
        "error" => $postModelFactory, // FIXME same here
        "help" => $postModelFactory// FIXME same issue.
      );

      // Views
      if (Console\Console::isConsole()) {
        $sanitizer = new Validation\ConsoleSanitizer(); 
        $viewFactory = new View\ViewFactory($sanitizer);
      } else {
        $sanitizer = new Validation\HtmlSanitizer(); 
        $viewFactory = new View\ViewFactory($sanitizer);
      }
    
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
