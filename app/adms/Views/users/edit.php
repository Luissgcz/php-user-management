<?php

namespace   App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;

echo "<h3>Edição do Usuário</h3>";

if ($this->data) {
    extract($this->data);
} else {
    $_SESSION['error'] = 'Erro ao Editar Usuário';
    header('Location:' . $_ENV['APP_DOMAIN'] . '/list-users');
    return;
}
?>

<form action="" method="POST">
    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_edit_user'); ?>">
    <label for="name">Nome:</label>
    <input type="text" id="name" for="name" name="name" placeholder="Digite Seu Nome" value="<?php echo $name; ?>">
    <label for="name">Email:</label>
    <input type="text" id="email" for="email" name="email" placeholder="Digite Seu Email" value="<?php echo $email; ?>">
    <input type="submit" name="edit_user" value="Editar">
</form>