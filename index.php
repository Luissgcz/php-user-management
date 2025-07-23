<?php

use Routes\PageController;

session_start();
ob_start();

require('./vendor/autoload.php');
date_default_timezone_set('America/Sao_Paulo');

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

$url = new PageController();
$url->loadPage();
