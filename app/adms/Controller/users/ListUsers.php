<?php

namespace app\adms\Controller\users;

use App\adms\Controller\Services\PaginationService;
use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;

class ListUsers
{
    /**
     * @var array|string|null $dados Recebe os dados que devem ser enviados para a VIEW
     */
    private array|string|null $data = null;

    /**
     * @var int $limitResults Recebe a quantidade de registros que deve retornar do banco de dados
     */
    private int $limitResults = 5;
    /**
     * Recuperar os Ultimos Usuários
     * @return void
     */
    public function index(string|int $page)
    {
        $listUsers = new UsersRepository();
        $this->data['head'] = 'Listar Usuário';
        $this->data['users'] = $listUsers->getAllUsers((int) $page, (int) $this->limitResults);
        $this->data['pagination'] = PaginationService::generatePagination((int)$listUsers->getAmountUser(), (int)$this->limitResults, (int)$page, 'list-users');

        //Carregar a View
        $loadView = new LoadViewService("adms/Views/users/list", $this->data);
        $loadView->loadView();
    }
}
