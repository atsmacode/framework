<?php

namespace Atsmacode\Database\Migrations;

use Atsmacode\Database\Pdo\Database;
class CreateDatabase extends Database
{
    public static array $methods = [
        'dropDatabase',
        'createDatabase'
    ];

    public function dropDatabase()
    {
        $sql = "DROP DATABASE IF EXISTS `{$this->database}`";

        try {
            $this->connection->exec($sql);
        } catch(\Exception $e) {
            error_log($e->getMessage());
        }

        return $this;
    }

    public function createDatabase()
    {
        $sql = "CREATE DATABASE `{$this->database}`";

        try {
            $this->connection->exec($sql);
        } catch(\Exception $e) {
            error_log($e->getMessage());
        }

        return $this;
    }
}
