<?php

namespace App\adms\Controller\login;

use App\adms\Views\Services\LoadViewService;
use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Helpers\CSFRHelper;
use App\adms\Models\Repository\UsersRepository;

class NewLogin
{
    private string|array|null $data = null;

    public function index()
    {
        $this->data['head'] = 'Cadastrar Usuário | Sistema CRUD MVC';


        $this->data['form'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if (isset($this->data['form']['csfr_tokens']) && CSFRHelper::validateCSFRToken('form_new_user', $this->data['form']['csfr_tokens'])) {
            $this->data['error'] = ValidationUserRakitService::validateNewLogin($this->data['form']);

            if (empty($this->data['error'])) {
                $newUser = new UsersRepository();
                $result = $newUser->newUser($this->data['form']['name'], $this->data['form']['email'], password_hash($this->data['form']['password'], PASSWORD_DEFAULT), time());
                if ($result) {
                    $_SESSION['success'] = 'Usuário Cadastrado com successo';
                    header('Location:' . $_ENV['APP_DOMAIN'] . '/login');
                    exit;
                }
            }
        }

        $loadView = new LoadViewService('adms/Views/login/newLogin', $this->data);
        $loadView->loadViewLogin();
    }
}
