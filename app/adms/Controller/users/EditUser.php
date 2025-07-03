<?php

namespace   App\adms\Controller\users;

use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;
use App\adms\Helpers\CSFRHelper;

class EditUser
{
    private string|null|array $data = null;
    public function index()
    {

        $editUser = new UsersRepository();
        // Tratando com AJAX
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
            $dataUpdate = filter_input_array(INPUT_POST, FILTER_DEFAULT);




            if (isset($dataUpdate) &&  CSFRHelper::validateCSFRToken('form_edit_user', $dataUpdate['csfr_tokens']) && $isAjax) {
                $this->data['error'] = ValidationUserRakitService::validateEditUser($dataUpdate ?? []);
                $result = $editUser->updateUser($dataUpdate['idUser'], $dataUpdate['name'], $dataUpdate['email'], time());

                if ($result) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Usuário atualizado com sucesso.' : 'Erro ao atualizar usuário.'
                    ]);
                    exit;
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => 'Token inválido.'
                ]);
                exit;
            }
        }


        $loadView = new LoadViewService('/adms/Views/users/list', $this->data);
        $loadView->loadView();
    }
}
