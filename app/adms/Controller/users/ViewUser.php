<?php


namespace App\adms\Controller\users;

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

        //Carregar a View
        $loadView = new LoadViewService("adms/Views/users/viewUser", $this->data);
        $loadView->loadView();
    }
}
