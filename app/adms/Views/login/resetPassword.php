<?php

use App\adms\Helpers\CSFRHelper;

if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $key => $value) {
        echo "<p style='color:red'>{$value}</p>";
    }
}


?>

<form method="POST">
    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_reset_password') ?>">
    <label for="password">Nova Senha</label>
    <input type="text" name="password" id="password" placeholder="Digite sua nova Senha">
    <label for="confirmPassword">Confirme sua Senha</label>
    <input type="text" name="confirmPassword" id="confirmPassword" placeholder="Confirme sua Senha">
    <input type="submit" value="Alterar Senha">
</form>