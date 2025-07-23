<?php

namespace App\adms\Controller\users;

use App\adms\Models\Services\DbConnection;
use App\adms\Views\Services\LoadViewService;

class FilterUsers extends DbConnection
{

    private $data = null;
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT) ?? '';
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
            $status = filter_input(INPUT_POST, 'status', FILTER_DEFAULT) ?? '';

            $query = "SELECT * FROM ads WHERE 1=1 ";
            $params = [];

            if (!empty($name)) {
                $query .= "AND LOWER(name) LIKE :name ";
                $params[':name'] = "%" . strtolower($name) . "%";
            }

            if (!empty($email)) {
                $query .= "AND LOWER(email) LIKE :email ";
                $params[':email'] = "%" . strtolower($email) . "%";
            }

            if (!empty($status)) {
                $query .= "AND LOWER(status) LIKE :status ";
                $params[':status'] = "%" . strtolower($status) . "%";
            }

            $query .= "ORDER BY name";

            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute($params);
            $users = $stmt->fetchAll();

            $this->data['users'] = $users;


            $loadView = new LoadViewService("adms/Views/users/tableUsers", $this->data);
            $loadView->loadPartialView();
        }
    }
}
