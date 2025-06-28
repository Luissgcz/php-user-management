<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;

// var_dump($this->data);
if (!empty($this->data['error'])) {
    foreach ($this->data['error'] as $erro) {
        echo "<p style='color:red'>{$erro}</p>";
    }
}
?>

<form action="" method="POST">
    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_create_user'); ?>">
    <label for="name">Nome:</label>
    <input type="text" id="name" for="name" name="name" placeholder="Digite Seu Nome" value="<?php echo $this->data['form']['name'] ?? '' ?>">
    <label for="email">Email:</label>
    <input type="text" id="email" for="email" name="email" placeholder="Digite Seu Email" value="<?php echo $this->data['form']['email'] ?? '' ?>">
    <label for="password">Senha:</label>
    <input type="text" id="password" for="password" name="password" placeholder="Digite Sua Senha" value="<?php echo $this->data['form']['password'] ?? '' ?>">
    <label for="confirmPassword">Confirmar Senha:</label>
    <input type="text" id="confirmPassword" for="confirmPassword" name="confirmPassword" placeholder="Confirme Sua Senha" value="<?php echo $this->data['form']['confirmPassword'] ?? '' ?>">
    <input type="submit" name="create_user" value="Cadastrar">
</form>