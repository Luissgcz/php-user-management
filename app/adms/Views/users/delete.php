<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 border rounded p-4 shadow-sm">
        <h5 class="text-center mb-4">Você tem certeza que deseja excluir o usuário?</h5>

        <form action="" method="POST">
            <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_delete_user'); ?>">

            <div class="d-flex justify-content-center gap-3">
                <input type="submit" name="delete_user" class="btn btn-danger px-4" value="Sim">
                <input type="button" name="not_delete_user" class="btn btn-secondary px-4" value="Não" onclick="window.location.href='../list-users';">
            </div>
        </form>
    </div>
</div>