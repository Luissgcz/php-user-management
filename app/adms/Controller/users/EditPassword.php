<?php

namespace App\adms\Controller\users;

use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;
use App\adms\Helpers\CSFRHelper;

class EditPassword
{
    private array|null $data = null;
    public function index(int|string $id)
    {

        $this->data['head'] = 'Editar Senha';

        $this->data['form'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $editPassword = new UsersRepository();

        $result = $editPassword->getUser($id);
        $passwordHash = $result['password'];

        $this->data['error'] = ValidationUserRakitService::validateUpdatePassword($this->data['form'] ?? []);



        if (empty($this->data['error'])) {
            if (isset($this->data['form']) && CSFRHelper::validateCSFRToken('form_update_password', $this->data['form']['csfr_tokens'])) {

                // Comparando Senha Atual do Banco com Senha Atual da View
                if (password_verify($this->data['form']['passwordCurrent'], $passwordHash)) {
                    // Hash da nova Senha
                    $hashPassword = password_hash($this->data['form']['newPassword'], PASSWORD_DEFAULT);

                    // Atualiza a senha no banco
                    if ($editPassword->updatePassword($id, $hashPassword, time())) {
                        $_SESSION['success'] = 'Senha alterada com sucesso.';
                        header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                        exit;
                    } else {
                        $_SESSION['error'] = 'Erro ao alterar a senha do usuário.';
                        header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                        exit;
                    }
                } else {
                    $_SESSION['error'] = 'Senha atual incorreta. Por favor, tente novamente.';
                    header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                    exit;
                }
            } else {
                $_SESSION['error'] = 'Acesso inválido ao tentar alterar a senha.';
                header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                exit;
            }
        } else {
        }


        $loadView = new LoadViewService('/adms/Views/users/updatePassword', $this->data);
        $loadView->loadView();
    }
}
