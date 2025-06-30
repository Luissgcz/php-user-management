<?php

use App\adms\Helpers\CSFRHelper;

// Exibe mensagens de erro
if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $value) {
        echo "<div class='alert alert-danger'>{$value}</div>";
    }
}

// Mensagens de sucesso
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}
?>


<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 login-container">
            <h3 class="text-center mb-3">Redefinir Senha</h3>
            <p class="text-center text-muted mb-4">Crie uma nova senha para sua conta</p>

            <form method="POST" action="#">

                <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_reset_password'); ?>">


                <div class="form-group">
                    <label for="password">Nova Senha:</label>
                    <input type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Digite sua nova senha"
                        required
                        value="<?php echo $this->data['form']['password'] ?? ''; ?>">
                </div>


                <div class="form-group mb-4">
                    <label for="confirmPassword">Confirme sua Senha:</label>
                    <input type="password"
                        id="confirmPassword"
                        name="confirmPassword"
                        class="form-control"
                        placeholder="Confirme a nova senha"
                        required
                        value="<?php echo $this->data['form']['confirmPassword'] ?? ''; ?>">
                </div>


                <input type="submit" class="btn btn-primary btn-block" value="Alterar Senha">
            </form>
        </div>
    </div>
</body>