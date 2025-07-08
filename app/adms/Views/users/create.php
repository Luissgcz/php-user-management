<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;

if (!empty($this->data['error'])) {
    foreach ($this->data['error'] as $erro) {
        echo "<div class='alert alert-danger' role='alert'>{$erro}</div>";
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

<div class="form-wrapper d-flex justify-content-center align-items-center">
    <div class="col-md-6 login-container">
        <h3 class="text-center mb-3">Criar Usuário</h3>
        <form action="" method="POST">
            <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_create_user'); ?>">

            <div class="form-group mb-3">
                <label for="name">Nome:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    placeholder="Digite Seu Nome"
                    value="<?php echo $this->data['form']['name'] ?? '' ?>"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Digite Seu Email"
                    value="<?php echo $this->data['form']['email'] ?? '' ?>"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="password">Senha:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Digite Sua Senha"
                    value="<?php echo $this->data['form']['password'] ?? '' ?>"
                    required>
            </div>

            <div class="form-group mb-4">
                <label for="confirmPassword">Confirmar Senha:</label>
                <input
                    type="password"
                    id="confirmPassword"
                    name="confirmPassword"
                    class="form-control"
                    placeholder="Confirme Sua Senha"
                    value="<?php echo $this->data['form']['confirmPassword'] ?? '' ?>"
                    required>
            </div>

            <input type="submit" name="create_user" class="btn btn-primary btn-block w-100" value="Cadastrar">
        </form>
    </div>
</div>