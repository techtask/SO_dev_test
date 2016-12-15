<?php

namespace silverorange\DevTest;

class Config
{
    protected $username;
    protected $dsn = 'pgsql:host=localhost;dbname=silverorange_dev_test;';
    protected $paths = array();
    protected $commandList = array();

    public function __construct($username, Array $paths, Array $commandList)
    {
        $this->username = $username;
        $this->dsn = $this->dsn . 'user=' . $this->username;
        $this->paths = $paths;
        $this->commandList = $commandList;
    }

    public function getDSN()
    {
        return $this->dsn;
    }

    public function getPaths()
    {
        return $this->paths;
    }

    public function getDefaultPath()
    {
        // FIXME This is hardcoded.. No schema validation for paths, or the rest of this config...
        return $this->paths["default"];
    }

    public function getCommandList()
    {
        return $this->commandList;
    }
}
