<?php

namespace App\adms\Views\login;

use App\adms\Helpers\CSFRHelper;

if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $key => $value) {
        echo "<p style='color:red'>{$value}</p>";
    }
}


?>


<form method="POST">
    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_new_user') ?>">
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" placeholder="Digite seu Nome" value="<?php echo $this->data['form']['name'] ?? "" ?>">

    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Digite Seu Email" value="<?php echo $this->data['form']['email'] ?? "" ?>">

    <label for="password">Senha</label>
    <input type="password" name="password" id="password" placeholder="Digite sua Senha" value="<?php echo $this->data['form']['password'] ?? "" ?>">

    <label for="confirmPassword">Senha</label>
    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirme sua Senha" value="<?php echo $this->data['form']['confirmPassword'] ?? "" ?>">

    <input type="submit" value="Cadastrar">
</form>

<a href="<?php echo $_ENV['APP_DOMAIN'] . '/login' ?>">Retornar a Pagina de Login</a>