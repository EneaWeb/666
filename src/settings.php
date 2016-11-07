<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // database connectino
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'dailyrage',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => '',
        ],

        // API settings
        'api' => [
            'key' => 'key',
            //'key' => '09F!j5yH5091o8G30Pp{d9wtT03r}H!6ad2|ILomXYl1bZv3"M@gP7wm6Xb@f',
        ],
    ],
];
