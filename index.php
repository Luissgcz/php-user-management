<?php

use Routes\PageController;

session_start();
ob_start();

require('./vendor/autoload.php');

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad(); // safeLoad evita erro se não existir
}

date_default_timezone_set('America/Sao_Paulo');

$url = new PageController();
$url->loadPage();
