<?php
// Renderizando a Conversa Inteira Já
if (isset($this->data['conversation'])) {
    extract($this->data);
    foreach ($conversation as $msg) {
        echo "User: " . $msg['sender_name'] . ": " . $msg['message'] . ' ' .  date('H:i', strtotime($msg['created_at'])) . "<br>";
    }
?>

    <form action="<?= getenv('APP_DOMAIN') . '/message-controller/?with=' . $with_user_id ?>" method="POST">
        <input type="hidden" name="receiver_id" value="<?= $with_user_id ?>">
        <textarea name="message" required></textarea>
        <button type="submit">Enviar</button>
    </form>
<?php
}
?>