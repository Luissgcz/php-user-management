<?php

require(__DIR__ . '/../vendor/autoload.php');

date_default_timezone_set(getenv('APP_TIMEZONE'));

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => getenv('APP_ENV'),
        'production' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST_PHINX'),
            'name' => getenv('DB_NAME_PHINX'),
            'user' => getenv('DB_USER_PHINX'),
            'pass' => getenv('DB_PASS_PHINX'),
            'port' => getenv('DB_PORT_PHINX'),
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST_PHINX'),
            'name' => getenv('DB_NAME_PHINX'),
            'user' => getenv('DB_USER_PHINX'),
            'pass' => getenv('DB_PASS_PHINX'),
            'port' => getenv('DB_PORT_PHINX'),
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST_PHINX'),
            'name' => getenv('DB_NAME_PHINX'),
            'user' => getenv('DB_USER_PHINX'),
            'pass' => getenv('DB_PASS_PHINX'),
            'port' => getenv('DB_PORT_PHINX'),
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation',
];
