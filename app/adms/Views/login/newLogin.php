<?php

namespace App\adms\Views\login;

use App\adms\Helpers\CSFRHelper;

// Exibe mensagens de erro
if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $value) {
        echo "<div class='alert alert-danger'>{$value}</div>";
    }
}

// Mensagens de sessão
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
            <h3 class="text-center mb-3">Cadastro de Usuário</h3>
            <p class="text-center text-muted mb-4">Preencha os dados abaixo para criar sua conta</p>

            <form action="#" method="post">

                <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_new_user'); ?>">

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        placeholder="Digite seu nome completo"
                        required
                        value="<?php echo $this->data['form']['name'] ?? ''; ?>">
                </div>


                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        placeholder="Digite seu e-mail"
                        required
                        value="<?php echo $this->data['form']['email'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Crie uma senha"
                        required
                        value="<?php echo $this->data['form']['password'] ?? ''; ?>">
                </div>


                <div class="form-group mb-4">
                    <label for="confirmPassword">Confirmar Senha:</label>
                    <input type="password"
                        name="confirmPassword"
                        id="confirmPassword"
                        class="form-control"
                        placeholder="Confirme sua senha"
                        required
                        value="<?php echo $this->data['form']['confirmPassword'] ?? ''; ?>">
                </div>

                <input type="submit" class="btn btn-primary btn-block" value="Cadastrar">


                <div class="text-center mt-3">
                    <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/login" class="text-decoration-none">Já tem uma conta? Fazer login</a>
                </div>
            </form>
        </div>
    </div>

</body>