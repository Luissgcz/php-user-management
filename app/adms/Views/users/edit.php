<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;

// Verifica se existem dados
if ($this->data) {
    extract($this->data);
} else {
    $_SESSION['error'] = 'Erro ao Editar Usuário';
    header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
    return;
}

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


<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 login-container">
        <h3 class="text-center mb-3">Edição do Usuário</h3>
        <p class="text-center text-muted mb-4">Atualize os dados do usuário abaixo</p>

        <form action="" method="POST">
            <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_edit_user'); ?>">
            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    placeholder="Digite seu nome"
                    required
                    value="<?php echo $name ?? ''; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="email">Email:</label>
                <input type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    placeholder="Digite seu e-mail"
                    required
                    value="<?php echo $email ?? ''; ?>">
            </div>

            <input type="submit" name="edit_user" class="btn btn-primary btn-block" value="Atualizar">

            <div class="text-center mt-3">
                <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/list-users" class="text-decoration-none">Voltar para lista</a>
            </div>
        </form>
    </div>
</div>