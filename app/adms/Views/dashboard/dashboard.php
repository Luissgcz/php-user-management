<?php
// Exemplo básico de View para dashboard de usuários

// Mensagens de erro
if (!empty($this->data['error'])) {
    foreach ($this->data['error'] as $erro) {
        echo "<p style='color:red'>{$erro}</p>";
    }
}

// Mensagem de sucesso
if (!empty($this->data['success'])) {
    echo "<p style='color:green'>{$this->data['success']}</p>";
}
?>

<div class="dashboard-header">
    <h1>Dashboard de Usuários</h1>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($this->data['users']) && is_array($this->data['users'])): ?>
            <?php foreach ($this->data['users'] as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <a href="edit-user.php?id=<?php echo $user['id']; ?>">Editar</a> |
                        <a href="delete-user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Confirma a exclusão deste usuário?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Nenhum usuário encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>