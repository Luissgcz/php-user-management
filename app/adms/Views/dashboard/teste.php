<?php
// Exemplo básico de View para dashboard de usuários

if (isset($this->data['messages'])) {
    $lastMessages = [];

    extract($this->data);
    foreach ($messages as $msg) {
        $senderId = $msg['sender_id'];

        // Sempre sobrescreve com a mensagem mais recente (porque estão em ordem decrescente)
        if (!isset($lastMessages[$senderId])) {
            $lastMessages[$senderId] = $msg;
            var_dump($lastMessages[$senderId]);
        }
    }

    // Exibe a última mensagem de cada remetente
    foreach ($lastMessages as $message) {
        $loggedUserId = $_SESSION['userId'];
        $otherUserId = ($loggedUserId === $message['sender_id']) ? $message['receiver_id'] : $message['sender_id'];
?>
        <div class='received-message'>
            <strong><?= $message['sender_name'] ?>:</strong>
            <?= $message['message'] ?> &nbsp;&nbsp;&nbsp;
            <small><?= date('H:i', strtotime($message['created_at'])) ?></small><br>
            <a href="<?= $_ENV['APP_DOMAIN'] ?>/message-controller/?with=<?= $otherUserId ?>">Visualizar Mensagem</a>
        </div>
<?php
    }
}
?>


<?php
if (isset($_SESSION['success'])) {
?>
    <div class='alert alert-success'><?= $_SESSION['success'] ?></div>
<?php
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
?>
    <div class='alert alert-danger'><?= $_SESSION['error'] ?></div>
    <?php
    unset($_SESSION['error']);
}

if (!empty($this->data['error'])) {
    foreach ($this->data['error'] as $erro) {
    ?>
        <p style="color:red"><?= $erro ?></p>
<?php
    }
}
?>

<form method="POST">
    <label for="receiver_id">Usuário que vai Receber a Mensagem</label>
    <input type="text" name="receiver_id" id="receiver_id" placeholder="Usuário que vai Receber a Mensagem">

    <label for="message">Mensagem</label>
    <input type="text" name="message" id="contentMessage" placeholder="Escreva a Mensagem a Ser Enviada">
    <input type="submit" value="Enviar Mensagem">
</form>


<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="chat3" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row h-100">
                            <!-- Lista de usuários -->
                            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                                <div class="p-3 h-100 d-flex flex-column">
                                    <div class="input-group rounded mb-3">
                                        <input
                                            type="search"
                                            class="form-control rounded"
                                            placeholder="Search"
                                            aria-label="Search"
                                            aria-describedby="search-addon" />
                                        <span
                                            class="input-group-text border-0"
                                            id="search-addon">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>

                                    <div class="chat-user-list flex-grow-1">
                                        <ul class="list-unstyled mb-0">
                                            <!-- Repetir esse bloco para cada contato -->
                                            <li class="p-2 border-bottom position-relative">
                                                <a href="#!" class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row">
                                                        <div class="position-relative">
                                                            <img
                                                                src="<?php echo $_ENV['APP_DOMAIN']; ?>/storage/uploads/profile/<?php echo $image ?? 'default.png'; ?>"
                                                                alt="avatar"
                                                                class="chat-avatar me-3" />
                                                            <span
                                                                class="badge bg-success badge-dot"></span>
                                                        </div>
                                                        <div class="pt-1">
                                                            <p class="fw-bold mb-0">NOME DO USUÁRIO</p>
                                                            <p class="small text-muted">
                                                                ULTIMA MENSAGEM DO USUÁRIO
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="pt-1">
                                                        <p class="small text-muted mb-1">Just now</p>
                                                        <span
                                                            class="badge bg-danger rounded-pill float-end">3</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- Outros contatos abaixo... -->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Mensagens -->
                            <div class="col-md-6 col-lg-7 col-xl-8 d-flex flex-column">
                                <div class="chat-messages flex-grow-1 pt-3">
                                    <!-- Bloco de mensagem recebida -->
                                    <div class="d-flex flex-row justify-content-start mb-3">
                                        <img
                                            src="<?php echo $_ENV['APP_DOMAIN']; ?>/storage/uploads/profile/<?php echo $image ?? 'default.png'; ?>"
                                            alt="avatar"
                                            class="chat-avatar me-2" />
                                        <div>
                                            <p class="small p-2 mb-1 rounded-3 bg-body-tertiary">
                                                SE TIVER MENSAGEM, RENDERIZA A CONVERSA AQUI DENTRO
                                            </p>
                                            <p class="small text-muted">HORARIO DA MENSAGEM</p>
                                        </div>
                                    </div>

                                    <!-- Bloco de mensagem enviada -->
                                    <div class="d-flex flex-row justify-content-end mb-3">
                                        <div class="text-end">
                                            <p
                                                class="small p-2 mb-1 text-white rounded-3 bg-primary">
                                                MENSAGEM DO PRÓPRIO USUÁRIO
                                            </p>
                                            <p class="small text-muted">HORARIO DA MENSAGEM</p>
                                        </div>
                                        <img
                                            src="<?php echo $_ENV['APP_DOMAIN']; ?>/storage/uploads/profile/<?php echo $image ?? 'default.png'; ?>"
                                            alt="avatar"
                                            class="chat-avatar ms-2" />
                                    </div>
                                </div>

                                <!-- Rodapé -->
                                <div class="chat-footer">
                                    <img
                                        src="<?php echo $_ENV['APP_DOMAIN']; ?>/storage/uploads/profile/<?php echo $image ?? 'default.png'; ?>"
                                        alt="avatar"
                                        class="chat-avatar" />


                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Escrever Mensagem" />
                                    <a href="#!" class="text-muted"><i class="fas fa-paperclip"></i></a>
                                    <a href="#!" class="text-muted"><i class="fas fa-smile"></i></a>
                                    <a href="#!" class="text-primary"><i class="fas fa-paper-plane"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>