<?php

namespace App\adms\Controller\dashboard;

use App\adms\Models\Repository\UsersRepository;
use App\adms\Views\Services\LoadViewService;

class Dashboard
{
    private string|array|null  $data = null;

    public function index()
    {
        $this->data['head'] = 'Dashboard';
        $listUsers = new UsersRepository();
        $this->data['userLogin'] = $listUsers->getUser($_SESSION['userId']);


        $loadView = new LoadViewService('adms/Views/dashboard/dashboard', $this->data);
        $loadView->loadView();
    }
}
