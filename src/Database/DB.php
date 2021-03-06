<?php

namespace silverorange\DevTest\Database;

class DB
{
    protected $pdo;
    protected $dsn;

    public function __construct($dsn)
    {
        $this->setDSN($dsn);
    }

    public function setDSN($dsn)
    {
        if ($this->dsn !== $dsn) {
            $this->dsn = $dsn;
            $this->pdo = null;
        }
    }

    public function getConnection()
    {
        if (!$this->pdo instanceof \PDO) {
            $this->pdo = new \PDO($this->dsn);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }
}
