<?php

use Routes\PageController;

session_start(); // Inciar a Sessão
ob_start(); //Buffer de Saida

require('./vendor/autoload.php');
date_default_timezone_set('America/Sao_Paulo');

$url = new PageController();
$url->loadPage();
