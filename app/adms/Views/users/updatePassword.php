<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;

if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $value) {
        echo "<div class='alert alert-danger' role='alert'>{$value}</div>";
    }
}

if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success' role='alert'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger' role='alert'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}


?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 login-container">
        <h3 class="text-center mb-3">Alterar Senha</h3>
        <p class="text-center text-muted mb-4">Informe sua senha atual e a nova senha desejada</p>

        <form method="POST" action="#">

            <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_update_password'); ?>">

            <div class="form-group mb-3">
                <label for="passwordCurrent">Senha Atual</label>
                <input type="password"
                    id="passwordCurrent"
                    name="passwordCurrent"
                    class="form-control"
                    placeholder="Digite sua senha atual"
                    required>
            </div>

            <div class="form-group mb-4">
                <label for="newPassword">Nova Senha</label>
                <input type="password"
                    id="newPassword"
                    name="newPassword"
                    class="form-control"
                    placeholder="Digite sua nova senha"
                    required>
            </div>

            <input type="submit" class="btn btn-primary btn-block w-100" value="Alterar Senha">
        </form>
    </div>
</div>