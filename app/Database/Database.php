<?php

namespace Atsmacode\Framework\Database;

use ReflectionClass;

class Database
{
    protected mixed  $connection;
    protected string $database;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection->getConnection();
        $this->database   = $connection->getDatabaseName();
    }
}
