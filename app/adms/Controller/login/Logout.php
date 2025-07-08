<?php

namespace App\adms\Controller\login;

use App\adms\Views\Services\LoadViewService;

class Logout
{
    public function index()
    {
        unset($_SESSION['user']);
        unset($_SESSION['userId']);
        $_SESSION['success'] = 'Deslogado com successo';
        header('Location:' . $_ENV['APP_DOMAIN']);
    }
}
