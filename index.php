<?php

use Routes\PageController;

session_start(); 
ob_start(); 

require('./vendor/autoload.php');
date_default_timezone_set('America/Sao_Paulo');

$url = new PageController();
$url->loadPage();
