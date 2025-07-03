<?php

use App\adms\Helpers\CSFRHelper;

?>

<div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="formEditUser">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditUserLabel">Edição do Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted text-center">Atualize os dados do usuário abaixo</p>

                    <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_edit_user'); ?>">
                    <input type="hidden" name="idUser" id="user_id" value="">

                    <div class="mb-3">
                        <label for="name">Nome:</label>
                        <input type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            placeholder="Digite seu nome"
                            required
                            value="<?php echo $name ?? ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            placeholder="Digite seu e-mail"
                            required
                            value="<?php echo $email ?? ''; ?>">
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <input type="submit" name="edit_user" class="btn btn-primary" value="Atualizar">
                </div>
            </form>

        </div>
    </div>
</div>