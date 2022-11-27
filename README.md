# Environment

## PHP

8.1.3

## MySQL

8.0.13

# Commands

## Linux
Run the unit test suite:

>dev/phpunit

## Windows
Run the unit test suite:

>.\dev\runtests.bat

# Configs

You need to add db.php and db-test.php to configure your local DB credentials, like so:

```
<?php

return [
    'servername' => "localhost",
    'username' => "DB_USER",
    'password' => "DB_PASSWORD",
    'database' => "orm_test"
];
```
