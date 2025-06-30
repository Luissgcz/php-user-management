<?php

use App\adms\Helpers\CSFRHelper;

// Exibe mensagens de erro
if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $value) {
        echo "<div class='alert alert-danger'>{$value}</div>";
    }
}

// Exibe mensagens de sucesso
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
            <h3 class="text-center mb-3">Recuperar Senha</h3>
            <p class="text-center text-muted mb-4">Informe seu e-mail para receber o código de recuperação</p>

            <form method="POST" action="#">

                <input type="hidden" name="csfr_token" value="<?php echo CSFRHelper::generateCSFRToken('form_recovery_password'); ?>">


                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Digite seu e-mail"
                        required
                        value="<?php echo $this->data['form']['email'] ?? ''; ?>">
                </div>


                <input type="submit" class="btn btn-primary btn-block" value="Enviar Código de Recuperação">


                <div class="text-center mt-3">
                    <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/login" class="text-decoration-none">Voltar para o login</a>
                </div>
            </form>
        </div>
    </div>


</body>