<?php

namespace App\adms\Views\users;

echo isset($_SESSION['success']) ? "<p style='color:green;'>{$_SESSION['success']}</p>" : "";
unset($_SESSION['success']);

// echo $this->data['pagination']['amount_records'];

if (($this->data['users'])) {
    echo "<h3>Listar Usuários</h3><br>";
    echo "<a href='{$_ENV['APP_DOMAIN']}/create-user'>Criar Usuários</a>";

    foreach ($this->data['users'] as $user) {
        extract($user);
        echo "<hr>";
        echo "Nome: $name<br>";
        echo "Email: $email<br>";
        echo "<a href='{$_ENV['APP_DOMAIN']}/view-user/{$id}'>Visualizar Usuário</a><br>";
        echo "<a href='{$_ENV['APP_DOMAIN']}/edit-user/{$id}'>Editar Usuário</a><br>";
        echo "<a href='{$_ENV['APP_DOMAIN']}/delete-user/{$id}'>Deletar Usuário</a><br>";
        echo "<hr>";
    }
    include_once('./app/adms/Views/partials/pagination.php');
} else {
    echo '<h3 style="color: #FF0000";>Não tem Usuário a Ser Listado</h3>';
}
