<?php

namespace   App\adms\Controller\users;

use App\adms\Helpers\CSFRHelper;
use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;

class DeleteUser
{
    private string|null|array $data = null;
    public function index(int|string $id)
    {
        $this->data['head'] = 'Deletar Usuário';
        $dataUpdate = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dataUpdate['csfr_tokens']) and CSFRHelper::validateCSFRToken('form_delete_user',  $dataUpdate['csfr_tokens'])) {
            $deleteUser =  new UsersRepository();
            $result = $deleteUser->deleteUser($id);
            if ($result) {
                $_SESSION['success'] = 'Usuário Excluido com successo';
                header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                return;
            } else {
                $_SESSION['error'] = 'Erro ao Excluir Usuário';
                header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                return;
            }
        }

        $deleteUser =  new LoadViewService('adms/Views/users/delete', $this->data);
        $deleteUser->loadView();
    }
}
