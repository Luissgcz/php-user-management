<?php

namespace App\adms\Controller\messages;

use App\adms\Models\Services\DbConnection;
use App\adms\Views\Services\LoadViewService;

class FilterUsersForSendMsg extends DbConnection
{
    private $data = null;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $name = filter_input(INPUT_GET, 'search', FILTER_DEFAULT) ?? '';

            $query = "SELECT id, name, email FROM ads WHERE 1=1";
            $params = [];

            if (!empty($name)) {
                $query .= " AND LOWER(name) LIKE :name";
                $params[':name'] = "%" . strtolower($name) . "%";
            }

            $query .= " ORDER BY name LIMIT 5";

            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute($params);
            $this->data['users'] = $stmt->fetchAll();

            $loadView = new LoadViewService("adms/Views/dashboard/userTablePartial", $this->data);
            $loadView->loadPartialView();
            return;
        }

        http_response_code(405);
        echo "Método não permitido";
    }
}
