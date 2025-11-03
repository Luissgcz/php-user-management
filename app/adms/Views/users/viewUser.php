<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;

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
} else {
    $_SESSION['error'] = 'Usuário não encontrado.';
    header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
    return;
}
?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header custom-header">
                    <h4 class="mb-0">Perfil do Usuário</h4>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="<?php echo $_ENV['APP_DOMAIN']; ?>/storage/uploads/profile/<?php echo $image ?? 'default.png'; ?>"
                            alt="Foto de Perfil" class="rounded-circle img-thumbnail"
                            style="width: 120px; height: 120px; object-fit: cover;">

                        <form method="POST"
                            enctype="multipart/form-data" class="mt-2">
                            <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_view_user_image') ?>">
                            <input type="file" name="profile_image" accept="image/*" class="form-control">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input class="btn btn-sm btn-primary mt-2" type="submit" value="Atualizar Foto" />
                        </form>
                    </div>

                    <form method="POST">
                        <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_view_user') ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">


                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?php echo $name; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo $email; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" name="phone" placeholder="(99) 99999-9999" pattern="^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$" class="form-control"
                                value="<?php echo $phone ?? ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="ativo" <?php echo ($status === 'ativo') ? 'selected' : ''; ?>>Ativo</option>
                                <option value="inativo" <?php echo ($status === 'inativo') ? 'selected' : ''; ?>>Inativo</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <input type="submit" class="btn btn-success" value="Salvar Alterações" />
                        </div>
                    </form>

                    <div class="mt-4">
                        <p><strong>Criado em:</strong> <?php echo date('d/m/Y H:i:s', strtotime($created_at)); ?></p>
                        <p><?php echo isset($updated_at) ? "<strong>Atualizado em: </strong>" . date('d/m/Y H:i:s', strtotime($updated_at)) : ''; ?></p>
                    </div>
                </div>

                <div class="card-footer bg-light text-center">
                    <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/list-users" class="btn btn-outline-secondary">
                        Voltar para Lista
                    </a>
                </div>
            </div>
        </div>
    </div>