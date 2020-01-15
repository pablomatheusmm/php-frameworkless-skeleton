<?php

return [
    'default' => [
        'driver'    => $_ENV['DB_DRIVER'],
        'host'      => $_ENV['DB_HOST'],
        'user'      => $_ENV['DB_USER'],
        'password'  => $_ENV['DB_PASSWORD'],
        'db_name'   => $_ENV['DB_NAME']
    ]
];
