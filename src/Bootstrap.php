<?php

namespace silverorange\Dev_Test;

public class Bootstrap
{

  /**
   * Initialize the application. Dependency injection done here.
   *
   */
  public function init()
  {
    $databaseUser = 'me';

    $config = new Config($databaseUser);

    $db = new DB($config->getDSN());

  }

}
