<?php

require(__DIR__ . '/../vendor/autoload.php');


$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..');
$dotenv->load();

date_default_timezone_set($_ENV['APP_TIMEZONE']);

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => $_ENV['APP_ENV'],
            'production' => [
                'adapter' => 'mysql',
                'host' => $_ENV['DB_HOST_PHINX'],
                'name' => $_ENV['DB_NAME_PHINX'],
                'user' => $_ENV['DB_USER_PHINX'],
                'pass' => $_ENV['DB_PASS_PHINX'],
                'port' => $_ENV['DB_PORT_PHINX'],
                'charset' => 'utf8',
            ],
            'development' => [
                'adapter' => 'mysql',
                'host' => $_ENV['DB_HOST_PHINX'],
                'name' => $_ENV['DB_NAME_PHINX'],
                'user' => $_ENV['DB_USER_PHINX'],
                'pass' => $_ENV['DB_PASS_PHINX'],
                'port' => $_ENV['DB_PORT_PHINX'],
                'charset' => 'utf8',
            ],
            'testing' => [
                'adapter' => 'mysql',
                'host' => $_ENV['DB_HOST_PHINX'],
                'name' => $_ENV['DB_NAME_PHINX'],
                'user' => $_ENV['DB_USER_PHINX'],
                'pass' => $_ENV['DB_PASS_PHINX'],
                'port' => $_ENV['DB_PORT_PHINX'],
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
