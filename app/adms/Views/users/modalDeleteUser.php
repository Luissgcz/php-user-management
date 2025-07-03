<?php

namespace App\adms\Views\users;

use App\adms\Helpers\CSFRHelper;
?>

<div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="modalDeleteUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="formDeleteUser">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteUserLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_delete_user'); ?>">
                    <input type="hidden" name="id" id="user_id" value="">

                    <p class="text-center">Você tem certeza que deseja excluir este usuário?</p>
                </div>

                <div class="modal-footer d-flex justify-content-center gap-2">
                    <input type="submit" name="delete_user" class="btn btn-danger px-4" value="Sim">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Não</button>
                </div>
            </form>

        </div>
    </div>
</div>