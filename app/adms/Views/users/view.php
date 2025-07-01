<?php

namespace App\adms\Views\users;

?>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
            unset($_SESSION['error']);
        }

        if (!empty($this->data['user'])) {
            extract($this->data['user']);
        ?>
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="mb-0">Detalhes do Usuário</h4>
                </div>
                <div class="card-body">
                    <p><strong>Usuário:</strong> <?php echo $name; ?></p>
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                    <p><strong>Username:</strong> <?php echo $username; ?></p>
                    <p><strong>Criado:</strong> <?php echo $created_at ? date('d/m/Y H:i:s', strtotime($created_at)) : ''; ?></p>
                    <p><strong></strong> <?php echo $updated_at ? 'Atualizado:' . date('d/m/Y H:i:s', strtotime($updated_at)) : ''; ?></p>
                </div>
                <div class="card-footer text-center bg-light">
                    <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/list-users" class="btn btn-outline-primary">
                        Voltar para a Lista de Usuários
                    </a>
                </div>
            </div>
        <?php
        } else {
            $_SESSION['error'] = 'Usuário não encontrado.';
            header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
            return;
        }
        ?>
    </div>
</div>