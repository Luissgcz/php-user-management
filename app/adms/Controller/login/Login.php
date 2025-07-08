<?php

namespace App\adms\Controller\login;

use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Helpers\CSFRHelper;
use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;

class Login
{
    private array|string|null  $data = null;

    public function index()
    {
        // var_dump($_SESSION);
        $this->data['head'] = 'Login | Sistema CRUD MVC';
        $this->data['form'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->data['form'])) {
            $this->data['error'] = ValidationUserRakitService::validateLogin($this->data['form'] ?? []);
        }

        if (empty($this->data['error'])) {
            if (isset($this->data['form']['csfr_tokens']) && CSFRHelper::validateCSFRToken('form_login', $this->data['form']['csfr_tokens'])) {
                $serviceDv = new UsersRepository();
                $result = $serviceDv->authUser($this->data['form']['email'], $this->data['form']['password']);

                if ($result) {
                    header('Location:' . $_ENV['APP_DOMAIN'] . '/dashboard');
                    exit;
                } else {
                    // echo "Erro ao Logar no Sistema<br>";
                    $_SESSION['error'] = 'Usuário ou Senha Incorreta';
                }
            }
        }

        $createUser = new LoadViewService("adms/Views/login/login", $this->data);
        $createUser->loadViewLogin();
    }
}
