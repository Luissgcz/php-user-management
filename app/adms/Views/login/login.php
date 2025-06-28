<?php

use App\adms\Helpers\CSFRHelper;

if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $key => $value) {
        echo "<p style='color:red'>{$value}</p>";
    }
}

echo isset($_SESSION['success']) ? "<p style='color:green;'>{$_SESSION['success']}</p>" : "";
unset($_SESSION['success']);
echo isset($_SESSION['error']) ? "<p style='color:red;'>{$_SESSION['error']}</p>" : "";
unset($_SESSION['error']);

?>

<h4>Formulario de Login</h4>

<form action="" method="POST">
    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_login') ?>">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Email de Acesso" required value="<?php echo ($this->data['form']['email'] ?? '') ?>">

    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" placeholder="Senha de Acesso" required value="<?php echo ($this->data['form']['password'] ?? '') ?>">
    <button type="submit" name="create_user">Acessar</button>
</form>


<a href="<?= $_ENV['APP_DOMAIN'] . '/new-login' ?>">Cadastrar novo Usuário</a>
<a href="<?= $_ENV['APP_DOMAIN'] . '/recovery-password' ?>">Recuperar Senha</a>