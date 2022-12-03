<?php

namespace Atsmacode\Framework\Migrations;

use Atsmacode\Framework\Dbal\Database;

class CreateTestTable extends Database
{
    public static array $methods = [
        'createTestTable',
    ];

    public function createTestTable()
    {
        $sql = "CREATE TABLE test (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL
            )";

        try {
            $this->connection->executeQuery($sql);
        } catch(\PDOException $e) {
            error_log($e->getMessage());
        }
    }
}
