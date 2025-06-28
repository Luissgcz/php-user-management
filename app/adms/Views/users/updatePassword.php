<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;

?>

<form action="" method="POST">
    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_update_password'); ?>">
    <label for="passwordCurrent">Senha Atual</label>
    <input type="text" name="passwordCurrent" for="passwordCurrent">
    <label for="newPassword">Senha Nova</label>
    <input type="text" name="newPassword" for="newPassword">
    <input type="submit" value="Alterar Senha">
</form>