<?php

namespace silverorange\DevTest;

class Config
{

  protected $username;
  protected $dsn = 'pgsql:host=localhost;dbname=silverorange_dev_test;';

  public function __construct($username)
  {
    $this->username = $username;
    $this->dsn = $this->dsn . 'user=' . $this->username;
  }

  public function getDSN()
  {
    return $this-dsn;
  }

}
