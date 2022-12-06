<?php

namespace Atsmacode\Framework\Database;

class Database
{
    protected string $database;

    public function __construct(ConnectionInterface $connection, array $data = null)
    {
        $this->connection = $connection->getConnection();
        $this->database   = $connection->getDatabaseName();
    }
}
