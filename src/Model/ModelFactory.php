<?php

namespace silverorange\DevTest\Model;

public class ModelFactory implements ModelFactoryInterface
{

  protected $dal;

  public function __construct(DatabaseAccessInterface $dal)
  {
    $this->dal = $dal;
  }
}
