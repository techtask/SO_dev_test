<?php

namespace silverorange\DevTest\Database;

class DatabaseAccessLayer implements DatabaseAccessInterface
{
    public function __construct(DB $db)
    {
        $this->db = $db;
    }
}
