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
        $this->data['userLogin'] = $user->getUser($_SESSION['userId']);

        $this->data['user'] = $user->getUser($id);

        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($_FILES['profile_image']) && CSFRHelper::validateCSFRToken('form_view_user_image', $formData['csfr_tokens'])) {
            if ($this->validateImageUser()) {
                $file = $_FILES['profile_image'];

                $userId = $formData['id'];

                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

                $newFileName = 'profile_' . $userId . '.' . $ext;


                $uploadDir = dirname(__DIR__, 4) . '/storage/uploads/profile/';
                $uploadPath = $uploadDir . $newFileName;


                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
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

        $loadView = new LoadViewService("adms/Views/users/viewUser", $this->data);
        $loadView->loadView();
    }

    private function validateImageUser(): bool
    {
        $fieldName = 'profile_image';


        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
            return false;
        }

        if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            var_dump($_FILES[$fieldName]['error']);
            $_SESSION['error'] = "Erro ao Realizar Upload";
            return false;
        }

        $allowedTypes = ['image/jpeg', 'image/png'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES[$fieldName]['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            $_SESSION['error'] = "Tipo de Arquivo Invalido";
            return false;
        }

        $maxSize = 10 * 1024 * 1024;
        if ($_FILES[$fieldName]['size'] > $maxSize) {
            $_SESSION['error'] = "Tamanho do Arquivo maior que 10MB";
            return false;
        }

        return true;
    }
}
