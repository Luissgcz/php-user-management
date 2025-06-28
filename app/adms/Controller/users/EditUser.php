<?php

namespace   App\adms\Controller\users;

use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;
use App\adms\Helpers\CSFRHelper;

class EditUser
{
    private string|null|array $data = null;
    public function index(int|string $id)
    {

        $editUser = new UsersRepository();
        $this->data = $editUser->getUser($id);
        $this->data['head'] = 'Editar Usuário';

        $dataUpdate = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dataUpdate['csfr_tokens']) and CSFRHelper::validateCSFRToken('form_edit_user',  $dataUpdate['csfr_tokens'])) {
            $result = $editUser->updateUser($id, $dataUpdate['name'], $dataUpdate['email'], time());
            if ($result) {
                $_SESSION['success'] = 'Usuário Editado com successo';
                header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                return;
            } else {
                $_SESSION['error'] = 'Erro ao Editar Usuário';
                header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                return;
            }
        } else {
            // echo "Autenticação Inválida";
        }

        //Carregar a View
        $loadView = new LoadViewService("adms/Views/users/edit", $this->data);
        $loadView->loadView();
    }
}
