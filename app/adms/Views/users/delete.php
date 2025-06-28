<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;

?>


<form action="" method="POST">
    <h5>Voce tem Certeza que deseja Excluir o Usuário?</h5>
    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_delete_user'); ?>">
    <input type="submit" name="delete_user" value="Sim">
    <input type="button" name="not_delete_user" value="Não" onclick="window.location.href='../list-users';">
</form>