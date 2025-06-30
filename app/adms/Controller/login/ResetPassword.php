<?php

namespace App\adms\Controller\login;

use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Helpers\CSFRHelper;
use App\adms\Models\Repository\RecoveryPasswordRepository;
use App\adms\Views\Services\LoadViewService;

class ResetPassword
{
    private string|array|null $data = null;
    private string|int $key;
    public function index($key)
    {
        $this->key = $key;
        $this->data['head'] = 'Redefinir Senha | Sistema CRUD MVC';

        //Primeiraa req vai ser GET então vai pular esse POST, depois vai chamar a view, sem resetar o CSFR token e ai vai validar corretamente
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->workFormData();
        }

        if ($this->validateResetPass()) {
            $this->loadView();
        }
    }

    public function validateResetPass()
    {
        $validation = new RecoveryPasswordRepository();

        $result =  $validation->validateResetPass($this->key);
        if (!$result) {
            $_SESSION['error'] = 'Chave de Recuperação Inválida';
            header('Location:' . $_ENV['APP_DOMAIN'] . '/login');
            exit;
        }

        $dateNow = date("Y-m-d H:i:s");
        $expireData = $result['validate_recovery_password'];

        if ($dateNow > $expireData) {
            $_SESSION['error'] = 'Código Expirado';
            header('Location:' . $_ENV['APP_DOMAIN'] . '/login');
            exit;
        }

        return true;
    }

    public function workFormData()
    {
        $this->data['form'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->data['error'] =  ValidationUserRakitService::validateRecoveryPassword($this->data['form']);
        if (empty($this->data['error']) && CSFRHelper::validateCSFRToken('form_reset_password', $this->data['form']['csfr_tokens'])) {
            $alterPassword = new RecoveryPasswordRepository();
            $hashPassword = password_hash($this->data['form']['password'], PASSWORD_DEFAULT);

            // if (!isset($_SESSION['emailRecoveryPassword'])) {
            //     $_SESSION['error'] = 'Sessão expirada. Solicite uma nova recuperação de senha.';
            //     header('Location:' . $_ENV['APP_DOMAIN'] . '/login');
            //     exit;
            // }

            $result = $alterPassword->alterPassword($this->key, $hashPassword);
            if ($result) {
                $_SESSION['success'] = 'Senha Alterada com successo';
                header('Location:' . $_ENV['APP_DOMAIN'] . '/login');
                exit;
            } else {
                $_SESSION['error'] = 'Não foi Possivel Alterar Sua Senha, Por Favor Tente Novamente';
                header('Location:' . $_ENV['APP_DOMAIN'] . '/login');
                exit;
            }
        }
    }


    public function loadView()
    {
        $loadView = new LoadViewService('adms/Views/login/resetPassword', $this->data);
        $loadView->loadViewLogin();
    }
}
