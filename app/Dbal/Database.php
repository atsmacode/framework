<?php

namespace Atsmacode\Database\Dbal;

use Atsmacode\Database\ConfigProvider;
use Doctrine\DBAL\DriverManager;

class Database
{
    protected string $database;

    public function __construct(ConfigProvider $configProvider)
    {
        $config = $configProvider->get();
        $env    = 'live';

        if (isset($GLOBALS['dev'])) { $env = 'test'; }

        $this->database   = $config['db'][$env]['database'];
        $this->connection = DriverManager::getConnection([
            'dbname'   => $config['db'][$env]['database'],
            'user'     => $config['db'][$env]['username'],
            'password' => $config['db'][$env]['password'],
            'host'     => $config['db'][$env]['servername'],
            'driver'   => $config['db'][$env]['driver'],
        ]);
    }
}
