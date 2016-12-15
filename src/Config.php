<?php

namespace silverorange\DevTest;

class Config
{
    protected $databaseUsername;
    protected $databasePassword;
    protected $dsn = 'pgsql:host=localhost;dbname=silverorange_dev_test;';
    protected $paths = array();
    protected $commandList = array();
    protected $defaultPath;

    public function __construct($databaseUsername, $databasePassword, Array $paths, Array $commandList, $defaultPath)
    {
        $this->databaseUsername = $databaseUsername;
        $this->databasePassword = $databasePassword;
        $this->dsn = $this->dsn . 'user=' . $this->databaseUsername . ';password=' . $this->databasePassword;
        $this->paths = $paths;
        $this->commandList = $commandList;
        $this->defaultPath = $defaultPath;
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
        return $this->defaultPath;
    }

    public function getCommandList()
    {
        return $this->commandList;
    }
}
