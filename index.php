<?php

use Routes\PageController;

session_start(); // Inciar a Sessão
ob_start(); //Buffer de Saida

//Carregar o Composer
require('./vendor/autoload.php');
date_default_timezone_set('America/Sao_Paulo');

#Comentado para Realizar Deploy da Aplicação
// $dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
// $dotenv->load();

$url = new PageController();
$url->loadPage();
