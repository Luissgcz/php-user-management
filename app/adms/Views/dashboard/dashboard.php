<?php

$loggedUserId = $_SESSION['userId'] ?? null;
$loggedUserName = $_SESSION['user'] ?? null;
$image = $_SESSION['image'] ?? 'default.png'; // imagem padrão se não tiver


if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}
if (!empty($this->data['error'])) {
    foreach ($this->data['error'] as $erro) {
        echo "<p style='color:red'>{$erro}</p>";
    }
}

// Se existirem mensagens...
$lastMessages = [];

//Conversa dos Usuários
$allMessages = $this->data['conversation'] ?? [];

//Barra Lateral das Ultimas Mensagens dos Usuário
$usersMessages = $this->data['messages'] ?? [];

// var_dump($this->data['messages']);
foreach ($allMessages as $msg) {
    $senderId = $msg['sender_id'];
    if (!isset($lastMessages[$senderId]) && $senderId !== $loggedUserId) {
        $lastMessages[$senderId] = $msg;
    }
}

// var_dump($usersMessages);

foreach ($usersMessages as $msg) {
    $senderId = $msg['sender_id'];
    $receiverId = $msg['receiver_id'];

    if (!isset($lastMessages[$senderId])) {
        if ($loggedUserId === $senderId) {
            $lastMessages[$receiverId] = $msg;
        } else {
            $lastMessages[$senderId] = $msg;
        }
    }
}



// var_dump($lastMessages);


// Pegando mensagens com um usuário específico (se estiver em uma conversa)
$chatWithUserId = $_GET['with'] ?? null;
$conversation = [];

if ($chatWithUserId) {
    foreach ($allMessages as $msg) {
        if (
            ($msg['sender_id'] == $loggedUserId && $msg['receiver_id'] == $chatWithUserId) ||
            ($msg['sender_id'] == $chatWithUserId && $msg['receiver_id'] == $loggedUserId)
        ) {
            $conversation[] = $msg;
        }
    }
    // var_dump($conversation);
}
?>

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
                                        <input type="search" class="form-control rounded" placeholder="Pesquisar usuário" />
                                        <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                                    </div>

                                    <div class="chat-user-list flex-grow-1">
                                        <ul class="list-unstyled mb-0">
                                            <?php foreach ($lastMessages as $msg):
                                                $userId = ($loggedUserId === $msg['sender_id']) ? $msg['receiver_id'] : $msg['sender_id'];
                                                $name = ($loggedUserName === $msg['sender_name']) ? $msg['receiver_name'] : $msg['sender_name'];
                                                $shortMsg = substr($msg['message'], 0, 30) . (strlen($msg['message']) > 30 ? '...' : '');
                                                $time =  date('H:i', strtotime($msg['created_at']));
                                            ?>
                                                <li class="p-2 border-bottom">
                                                    <a href="?with=<?= $userId ?>" class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row">
                                                            <div class="position-relative">
                                                                <img src="<?= $_ENV['APP_DOMAIN'] ?>/storage/uploads/profile/default.png" class="chat-avatar me-3" />
                                                                <span class="badge bg-success badge-dot"></span>
                                                            </div>
                                                            <div class="pt-1">
                                                                <p class="fw-bold mb-0"><?= htmlspecialchars($name) ?></p>
                                                                <p class="small text-muted"><?= htmlspecialchars($shortMsg) ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="pt-1">
                                                            <p class="small text-muted mb-1"><?= $time ?></p>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Conversa -->
                            <div class="col-md-6 col-lg-7 col-xl-8 d-flex flex-column">
                                <div class="chat-messages flex-grow-1 pt-3" style="overflow-y:auto; max-height:500px;">
                                    <?php if ($chatWithUserId): ?>
                                        <?php foreach ($conversation as $msg):
                                            $isOwn = $msg['sender_id'] == $loggedUserId;
                                            $formattedTime = date('H:i', strtotime($msg['created_at']));
                                        ?>
                                            <?php if ($isOwn): ?>
                                                <!-- Mensagem enviada -->
                                                <div class="d-flex flex-row justify-content-end mb-3">
                                                    <div class="text-end">
                                                        <p class="small p-2 mb-1 text-white rounded-3 bg-primary">
                                                            <?= htmlspecialchars($msg['message']) ?>
                                                        </p>
                                                        <p class="small text-muted"><?= $formattedTime ?></p>
                                                    </div>
                                                    <img src="<?= $_ENV['APP_DOMAIN'] ?>/storage/uploads/profile/<?= $image ?>" class="chat-avatar ms-2" />
                                                </div>
                                            <?php else: ?>
                                                <!-- Mensagem recebida -->
                                                <div class="d-flex flex-row justify-content-start mb-3">
                                                    <img src="<?= $_ENV['APP_DOMAIN'] ?>/storage/uploads/profile/default.png" class="chat-avatar me-2" />
                                                    <div>
                                                        <p class="small p-2 mb-1 rounded-3 bg-body-tertiary">
                                                            <?= htmlspecialchars($msg['message']) ?>
                                                        </p>
                                                        <p class="small text-muted"><?= $formattedTime ?></p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-center">Selecione um contato para iniciar a conversa</p>
                                    <?php endif; ?>
                                </div>

                                <!-- Rodapé -->
                                <form method="POST" class="chat-footer d-flex align-items-center gap-2 mt-3">
                                    <input type="hidden" name="receiver_id" value="<?= $chatWithUserId ?>">
                                    <img src="<?= $_ENV['APP_DOMAIN'] ?>/storage/uploads/profile/<?= $image ?>" class="chat-avatar" />
                                    <input type="text" name="message" class="form-control" placeholder="Escreva uma mensagem" required />
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>