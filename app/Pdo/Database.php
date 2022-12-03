<?php

namespace Atsmacode\Framework\Pdo;

use Atsmacode\Framework\ConfigProvider;
use PDO;

/**
 * This class is only used to easily create databases.
 */
class Database
{
    public function __construct(ConfigProvider $configProvider)
    {
        $config = $configProvider->get();
        $env    = 'live';

        if (isset($GLOBALS['dev'])) { $env = 'test'; }

        $this->database   = $config['db'][$env]['database'];
        $this->connection = new PDO(
            'mysql:host=' . $config['db'][$env]['servername'],
            $config['db'][$env]['username'],
            $config['db'][$env]['password']
        );

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
