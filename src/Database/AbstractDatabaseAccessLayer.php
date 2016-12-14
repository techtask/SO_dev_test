<?php

namespace silverorange\DevTest\Database;

public abstract class AbstractDatabaseAccessLayer implements DatabaseAccessInterface
{
  public function __construct(DB $db)
  {
    $this->db = $db;
  }

  abstract public function create();
  abstract public function read();
  abstract public function update();
  abstract public function destroy();
}
