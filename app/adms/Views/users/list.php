<?php

use App\adms\Helpers\CSFRHelper;


//Gerando o Token Antes para não sobreescrever o mesmo dentro do ForEach
$csrfEditUser = CSFRHelper::generateCSFRToken('form_edit_user');
$csrfDeleteUser = CSFRHelper::generateCSFRToken('form_delete_user');


if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $value) {
        echo "<div class='alert alert-danger' role='alert'>{$value}</div>";
    }
}


if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success' role='alert'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}


if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger' role='alert'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}


?>

<a href="<?php echo $_ENV['APP_DOMAIN']; ?>/create-user" class="btn btn-success">Criar Usuário</a>


<?php
if (($this->data['users'])) {

?>

    <link rel="stylesheet" href="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/css/listUsers/listUsers.css" />
    <link rel="stylesheet" href="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/listUsers/modalAction.js" />

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
                        <a data-bs-toggle="modal" data-bs-target="#modalViewUser" data-bs-whatever="@mdo" data-user-id="<?php echo $user['id'] ?>" data-user-name="<?php echo $name; ?>" data-user-email="<?php echo $email ?>" data-user-username="<?php echo $username ?>" data-user-created="<?php echo $created_at  ?? '' ?>" data-user-updated="<?php echo $updated_at  ?? '' ?>" class=" table-link text-primary me-2">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a data-user-token="<?php echo $csrfEditUser; ?>" data-bs-toggle="modal" data-bs-target="#modalEditUser" data-bs-whatever="@fat" data-user-id="<?php echo $user['id'] ?>" data-user-name="<?php echo $name; ?>" data-user-email="<?php echo $email ?>" class="table-link text-warning me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a data-user-token="<?php echo $csrfDeleteUser; ?>" data-bs-toggle="modal" data-bs-target="#modalDeleteUser" data-user-id="<?php echo $user['id'] ?>" data-bs-whatever="@getbootstrap" class=" table-link text-danger">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>

    <?php

    include_once('./app/adms/Views/partials/pagination.php');
    include_once(__DIR__ . '/modalEditUser.php');
    include_once(__DIR__ . '/modalViewUser.php');
    include_once(__DIR__ . '/modalDeleteUser.php');

    ?>


<?php
} else {
    // Caso não tenha usuários
    echo '<div class="alert alert-danger text-center" role="alert">
            <h4 class="mb-0">Não há usuários a serem listados.</h4>
          </div>';
}
?>