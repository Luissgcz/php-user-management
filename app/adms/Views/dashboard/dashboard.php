<?php

// var_dump($this->data);
echo isset($_SESSION['user']) ? "<p style='color:green;'> Bem Vindo {$_SESSION['user']} </p>" : "";
// unset($_SESSION['user']);