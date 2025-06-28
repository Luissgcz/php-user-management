<?php

use App\adms\Helpers\CSFRHelper;

if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $key => $value) {
        echo "<p style='color:red'>{$value}</p>";
    }
}
?>

<form method="POST">
    <input type="hidden" name="csfr_token" value="<?php echo CSFRHelper::generateCSFRToken('form_recovery_password') ?>">
    <label for="email">Email do Usuário</label>
    <input type="text" name="email" id="email" placeholder="Digite seu Email">
    <input type="submit" value="Enviar Código de Recuperação">
</form>

<a href="<?php echo $_ENV['APP_DOMAIN'] . '/login' ?>">Retornar a Pagina de Login</a>