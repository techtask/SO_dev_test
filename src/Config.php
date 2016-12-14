<?php

namespace silverorange\DevTest;

class Config
{
    protected $username;
    protected $dsn = 'pgsql:host=localhost;dbname=silverorange_dev_test;';
    protected $paths = array();

    public function __construct($username, array $paths)
    {
        $this->username = $username;
        $this->dsn = $this->dsn . 'user=' . $this->username;
        $this->paths = $paths;
    }

    public function getDSN()
    {
        return $this-dsn;
    }

    public function getPaths()
    {
        return $this->paths;
    }

    public function getDefaultPath()
    {
        // FIXME This is hardcoded.. No schema validation for paths.
    return $this->paths["default"];
    }
}
