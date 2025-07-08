<?php

namespace   App\adms\Controller\users;

use App\adms\Controller\Services\Validation\ValidationEmptyField;
use App\adms\Controller\Services\Validation\ValidationUserService;
use App\adms\Controller\Services\Validation\ValidationUserRakitService;
use App\adms\Helpers\CSFRHelper;
use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;

class CreateUser
{
    /**
     * @var array|string|null $dados Recebe os dados que devem ser enviados para a VIEW
     */
    private array|string|null $data = null;

    public function index()
    {

        $this->data['head'] = 'Criar Usuário';
        $insertUser = new UsersRepository();
        $this->data['userLogin'] = $insertUser->getUser($_SESSION['userId']);
        $this->data['form'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->data['form']['csfr_tokens']) && CSFRHelper::validateCSFRToken('form_create_user', $this->data['form']['csfr_tokens'])) {

            // $this->data['error'] = array_merge(
            // ValidationUserService::validate($this->data['form']) ?? [],
            // ValidationEmptyField::validateEmptyField($this->data['form']) ?? [],

            //Validando Utilizando Biblioteca Rakit
            $this->data['error'] = ValidationUserRakitService::validateCreateUser($this->data['form'] ?? []);
            // );


            if (empty($this->data['error'])) {

                $result = $insertUser->insertUser($this->data['form']['name'], $this->data['form']['email'], password_hash($this->data['form']['password'], PASSWORD_DEFAULT), time());

                if ($result) {
                    $_SESSION['success'] = 'Usuário Cadastrado com successo';
                    header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
                    exit;
                }
            }
        }
        $createUser = new LoadViewService("adms/Views/users/create", $this->data);
        $createUser->loadView();
    }
}
