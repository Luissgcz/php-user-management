<?php
// Exemplo básico de View para dashboard de usuários
var_dump($this->data);

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