<?php

namespace Atsmacode\Framework;

class DbConfig
{
    public function __invoke()
    {
        $dbTest = require($GLOBALS['THE_ROOT'] . 'config/db_database_test.php');
        $db     = require($GLOBALS['THE_ROOT'] . 'config/db_database.php');

        $dbConfig = [
            'db' => [
                'test' => $dbTest,
                'live' => $db,
            ],
        ];

        return $dbConfig;
    }
}
