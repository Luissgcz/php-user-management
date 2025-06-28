<?php

namespace App\adms\Views\users;

echo isset($_SESSION['success']) ? "<p style='color:green;'>{$_SESSION['success']}</p>" : "";
unset($_SESSION['success']);
echo isset($_SESSION['error']) ? "<p style='color:red;'>{$_SESSION['error']}</p>" : "";
unset($_SESSION['error']);

if ($this->data['user']) {
    echo "<br>";
    extract($this->data['user']);
    echo "Usuário: $name<br>";
    echo "Email: $email<br>";
    echo "Username: $username<br>";
    // echo "Password: $password<br>";
    //Operador Ternário nas minhas duas variaveis created e updated, se existir formata e mostra na tela, se não existir "" recebe uma string vazia
    echo "Criado:" . ($created_at ? date('d/m/Y H:i:s', strtotime($created_at)) : "") . "<br>";
    echo $updated_at ? 'Atualizado:' . date('d/m/Y H:i:s', strtotime($updated_at)) : "";
} else {
    $_SESSION['error'];
    header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
}
