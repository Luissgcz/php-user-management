<?php

namespace App\adms\Controller\dashboard;

use App\adms\Views\Services\LoadViewService;

class Dashboard
{
    private string|array|null  $data = null;

    public function index()
    {
        $this->data['head'] = 'Dashboard';

        $loadView = new LoadViewService('adms/Views/dashboard/dashboard', $this->data);
        $loadView->loadView();
    }
}
