<?php

namespace Atsmacode\Database\Dbal;

use Doctrine\DBAL\DriverManager;

class Database
{
    public function __construct()
    {
        $dbConfig = 'config/db_database.php';

        if (isset($GLOBALS['dev'])) {
            $dbConfig = 'config/db_database_test.php';
        }

        $dbConfig = require($GLOBALS['THE_ROOT'] . $dbConfig);

        $this->connection = DriverManager::getConnection(([
            'dbname'   => $dbConfig['database'],
            'user'     => $dbConfig['username'],
            'password' => $dbConfig['password'],
            'host'     => $dbConfig['servername'],
            'driver'   => $dbConfig['driver'],
        ]));
    }
}
