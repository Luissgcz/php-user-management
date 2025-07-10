<?php
// Exemplo básico de View para dashboard de usuários

var_dump($this->data);


if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}

// Mensagens de erro
if (!empty($this->data['error'])) {
    foreach ($this->data['error'] as $erro) {
        echo "<p style='color:red'>{$erro}</p>";
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