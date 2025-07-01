<?php

namespace App\adms\Views\users;

if (isset($_SESSION['success'])) {
    echo "<p style='color:green;'>{$_SESSION['success']}</p>";
    unset($_SESSION['success']);
}

?>

<a href="<?php echo $_ENV['APP_DOMAIN']; ?>/create-user" class="btn btn-success">Criar Usuário</a><br><br>

<?php
if (!empty($this->data['users'])) {
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/css/listUsers/listUsers.css" />
    <table class="table user-list">
        <thead>
            <tr>
                <th><span>User</span></th>
                <th><span>Created</span></th>
                <th class="text-center"><span>Status</span></th>
                <th><span>Email</span></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($this->data['users'] as $user) {
                extract($user);
            ?>
                <tr>
                    <td>
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/view-user/<?php echo $user['id']; ?>" class="user-link"><?php echo $name; ?></a>
                        <span class="user-subhead">Admin</span>
                    </td>
                    <td><?php echo $created_at; ?></td>
                    <td class="text-center">
                        <span class="label label-default">Inactive</span>
                    </td>
                    <td><?php echo $email; ?></td>
                    <td style="width: 20%;">
                        <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/view-user/<?php echo $user['id']; ?>" class="table-link text-primary me-2">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/edit-user/<?php echo $user['id']; ?>" class="table-link text-warning me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/delete-user/<?php echo $user['id']; ?>" class="table-link text-danger">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <?php include_once('./app/adms/Views/partials/pagination.php'); ?>

<?php
} else {
    // Caso não tenha usuários
    echo '<h3 style="color: #FF0000;">Não tem Usuário a Ser Listado</h3>';
}
?>