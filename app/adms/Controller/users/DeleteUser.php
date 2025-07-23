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
        $deleteUser = new UsersRepository();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
            $dataUpdate = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if ($dataUpdate && CSFRHelper::validateCSFRToken('form_delete_user', $dataUpdate['csfr_tokens'] ?? '')) {

                if ($isAjax) {
                    $result = $deleteUser->deleteUser($dataUpdate['id']);
                } else {
                    $result = $deleteUser->deleteUser($id);
                }
                
                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Usuário Deletado com sucesso.' : 'Erro ao Deletar usuário.'
                    ]);
                    exit;
                } else {
                    $_SESSION['success'] = $result ? 'Usuário Deletado com sucesso' : 'Erro ao Deletar Usuário';
                    header('Location:' . getenv('APP_DOMAIN') . '/list-users');
                    return;
                }
            } else {
                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'message' => 'Token CSRF inválido.'
                    ]);
                    exit;
                } else {
                    $_SESSION['error'] = 'Autenticação inválida';
                    header('Location:' . getenv('APP_DOMAIN') . '/list-users');
                    return;
                }
            }
        }


        header('Location:' . getenv('APP_DOMAIN') . '/Error403');
        exit;
    }
}
