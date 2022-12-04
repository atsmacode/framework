<?php

return [
    'framework' => [
        'db' => [
            'live' => [
                'servername' => 'localhost',
                'username'   => 'root',
                'password'   => 'PASSWORD',
                'database'   => 'framework',
                'driver'     => 'pdo_mysql',
            ],
            'test' => [
                'servername' => 'localhost',
                'username'   => 'root',
                'password'   => 'PASSWORD',
                'database'   => 'framework_test',
                'driver'     => 'pdo_mysql',
            ],
        ]
    ]
];
