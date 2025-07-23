<?php if (!empty($this->data['users'])): ?>
    <?php foreach ($this->data['users'] as $user): ?>
        <tr class="linha-ajustada">
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <a href="<?= getenv('APP_DOMAIN') ?>/dashboard/?with=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Conversar</a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4">Nenhum usuário encontrado.</td>
    </tr>
<?php endif; ?>