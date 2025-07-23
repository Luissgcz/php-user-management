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
            $dataUpdate = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (isset($dataUpdate) && CSFRHelper::validateCSFRToken('form_edit_user', $dataUpdate['csfr_tokens'])) {
                $this->data['error'] = ValidationUserRakitService::validateEditUser($dataUpdate ?? []);

                if (empty($this->data['error'])) {
                    $result = $editUser->updateUser($dataUpdate['idUser'], $dataUpdate['name'], $dataUpdate['email'], time());

                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Usuário Atualizado com Sucesso' : 'Falha ao atualizar usuário'
                    ]);
                    exit;
                } else {
                    header('Content-Type: application/json');

                    $message = $this->data['error'];
                    if (is_array($message)) {
                        $message = implode(' | ', $message);
                    }

                    echo json_encode([
                        'success' => false,
                        'message' => $message
                    ]);
                    exit;
                }
            }

            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Requisição Inválida ou Token CSRF inválido.'
            ]);
            exit;
        }
    }
}
