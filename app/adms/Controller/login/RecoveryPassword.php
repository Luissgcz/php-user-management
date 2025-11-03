<?php

namespace App\adms\Controller\login;

use App\adms\Controller\Services\SendEmail;
use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Helpers\CSFRHelper;
use App\adms\Helpers\GenerateKeyRecovery;
use App\adms\Models\Repository\RecoveryPasswordRepository;
use App\adms\Views\Services\LoadViewService;

class RecoveryPassword
{
    private string|array|null $data = null;

    public function index()
    {
        $this->data['head'] = 'Recuperar Senha | Sistema CRUD MVC';
        $this->data['form'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if (isset($this->data['form'])) {
            $this->data['error'] = ValidationUserRakitService::validateRecoveryEmail($this->data['form']);

            if (empty($this->data['error']) && CSFRHelper::validateCSFRToken('form_recovery_password', $this->data['form']['csfr_tokens'])) {
                $serviceRepository = new RecoveryPasswordRepository();
                $resultEmail = $serviceRepository->validateEmailExists($this->data['form']['email']);
                if ($resultEmail) {
                    $key = GenerateKeyRecovery::GenerateKeyRecoveryPassword();
                    $serviceRepository->insertDataRecovery($this->data['form']['email'], $key, date("Y-m-d H:i:s", strtotime("+30 minutes")));
                    SendEmail::SendEmailRecoveryPassword($key, $this->data['form']['email'], $resultEmail['name']);
                    $_SESSION['success'] = 'Email de Recuperação Enviado';
                    header('Location:' . $_ENV['APP_DOMAIN'] . '/login');
                    exit;
                } else {
                    $this->data['error'] = ['error' => 'Usuário Não Encontrado'];
                }
            }

            $loadView = new LoadViewService('adms/Views/login/recoveyPassword', $this->data);
            $loadView->loadViewLogin();
        }

        $loadView = new LoadViewService('adms/Views/login/recoveryPassword', $this->data);
        $loadView->loadViewLogin();
    }
}
