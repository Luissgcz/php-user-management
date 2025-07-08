<?php


namespace App\adms\Controller\users;

use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Helpers\CSFRHelper;
use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;

class ViewUser
{
    private array|string|null $data = null;

    public function index(int|string $id)
    {
        $this->data['head'] = 'Visualizar Usuário';

        $user = new UsersRepository();
        $this->data['user'] = $user->getUser($id);

        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($_FILES['profile_image']) && CSFRHelper::validateCSFRToken('form_view_user_image', $formData['csfr_tokens'])) {
            if ($this->validateImageUser()) {
                $file = $_FILES['profile_image'];

                $userId = $formData['id'];

                // Pega a extensão do arquivo (ex: jpg, png)
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

                // Define o nome do arquivo como: profile_289.jpg
                $newFileName = 'profile_' . $userId . '.' . $ext;

                // Caminho absoluto da pasta onde será salvo
                $uploadDir = dirname(__DIR__, 4) . '/storage/uploads/profile/';
                $uploadPath = $uploadDir . $newFileName;

                // Move o arquivo da pasta temporária para o destino final
                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    // Atualiza o banco com o novo nome
                    $user->updateImg($userId, $newFileName);
                    $_SESSION['success'] = "Imagem salva com sucesso!";
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao salvar o arquivo.";
                }
            }
        }

        if (isset($formData) && CSFRHelper::validateCSFRToken('form_view_user', $formData['csfr_tokens'])) {
            $this->data['error'] = ValidationUserRakitService::validateEditUser($formData ?? []);
            if (empty($this->data['error'])) {
                $result = $user->updateUserInfo($formData['id'], $formData['name'], $formData['email'], time(), $formData['phone'], $formData['status']);
                if ($result) {
                    $_SESSION['success'] = "Usuário Editado com Sucesso";
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao Editar Usuário";
                }
            }
        }

        //Carregar a View
        $loadView = new LoadViewService("adms/Views/users/viewUser", $this->data);
        $loadView->loadView();
    }

    private function validateImageUser(): bool
    {
        // Nome do campo no formulário
        $fieldName = 'profile_image';

        // Verifica se arquivo foi enviado
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
            // Nenhum arquivo enviado, pode considerar válido se não obrigatório
            return false;
        }

        // Verifica erros no Upload
        if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            var_dump($_FILES[$fieldName]['error']);
            $_SESSION['error'] = "Erro ao Realizar Upload";
            return false;
        }

        // Valida tipo MIME permitido
        $allowedTypes = ['image/jpeg', 'image/png'];

        // Para garantir, obtém MIME real do arquivo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES[$fieldName]['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            $_SESSION['error'] = "Tipo de Arquivo Invalido";
            return false;
        }

        // Valida tamanho máximo (ex: 2MB = 2 * 1024 * 1024 bytes)
        $maxSize = 10 * 1024 * 1024;
        if ($_FILES[$fieldName]['size'] > $maxSize) {
            $_SESSION['error'] = "Tamanho do Arquivo maior que 2MB";
            return false;
        }

        // Passou em todas as validações
        return true;
    }
}
