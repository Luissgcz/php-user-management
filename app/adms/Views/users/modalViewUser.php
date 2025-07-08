<div class="modal fade" id="modalViewUser" tabindex="-1" aria-labelledby="modalViewUserLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog  modal-dialog-centered modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalViewUserLabel">Detalhes do Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <p><strong>Usuário:</strong> <span id="user_name"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Email:</strong> <span id="user_email"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Criado em:</strong> <span id="user_created_at"></span></p>
                </div>
                <div class="mb-3" id="updated_at_container" style="display: none;">
                    <p><strong>Atualizado em:</strong> <span id="user_updated_at"></span></p>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>

        </div>
    </div>
</div>