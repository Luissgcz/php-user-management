<?php

namespace App\adms\Controller\users;

use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;
use App\adms\Helpers\CSFRHelper;

class EditPassword
{
    private array|null $data = null;
    public function index()
    {
        $id = $_SESSION['userId'];
        $this->data['head'] = 'Editar Senha';

        $this->data['form'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $editPassword = new UsersRepository();
        $this->data['userLogin'] =  $editPassword->getUser($_SESSION['userId']);

        if (!empty($this->data['form'])) {
            $result = $editPassword->getUserAdm($id);
            $passwordHash = $result['password'];

            $this->data['error'] = ValidationUserRakitService::validateUpdatePassword($this->data['form'] ?? []);



            if (empty($this->data['error'])) {
                if (isset($this->data['form']) && CSFRHelper::validateCSFRToken('form_update_password', $this->data['form']['csfr_tokens'])) {


                    if (password_verify($this->data['form']['passwordCurrent'], $passwordHash)) {
                        $hashPassword = password_hash($this->data['form']['newPassword'], PASSWORD_DEFAULT);

                        if ($editPassword->updatePassword($id, $hashPassword, time())) {
                            $_SESSION['success'] = 'Senha alterada com sucesso.';
                            header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                            exit;
                        } else {
                            $_SESSION['error'] = 'Erro ao alterar a senha do usuário.';
                            header('Location:' . $_ENV['APP_DOMAIN'] . '/edit-password');
                            exit;
                        }
                    } else {
                        $_SESSION['error'] = 'Senha atual incorreta';
                        header('Location:' . $_ENV['APP_DOMAIN'] . '/edit-password');
                        exit;
                    }
                } else {
                    $_SESSION['error'] = 'Acesso inválido ao tentar alterar a senha.';
                    header('Location:' . $_ENV['APP_DOMAIN'] . '/edit-password');
                    exit;
                }
            }
        }

        $loadView = new LoadViewService('/adms/Views/users/updatePassword', $this->data);
        $loadView->loadView();
    }
}
