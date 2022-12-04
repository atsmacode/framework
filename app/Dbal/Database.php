<?php

namespace Atsmacode\Framework\Dbal;

use Atsmacode\Framework\ConfigProvider;

class Database
{
    protected string $database;

    public function __construct(ConfigProvider $configProvider)
    {
        $config     = $configProvider->get();
        $env        = 'live';
        $connection = $GLOBALS['connection'];

        if (isset($GLOBALS['dev'])) { $env = 'test'; }

        $this->database   = $config['db'][$env]['database'];
        $this->connection = $connection;
    }
}
