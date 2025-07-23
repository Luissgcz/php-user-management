<?php
// Usa $this->data['users'] como no seu código original

use App\adms\Helpers\CSFRHelper;

if (!empty($this->data['users'])) :
    $csrfEditUser = CSFRHelper::generateCSFRToken('form_edit_user');
    $csrfDeleteUser = CSFRHelper::generateCSFRToken('form_delete_user');
?>
    <link rel="stylesheet" href="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/css/listUsers/listUsers.css" />
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
            <?php foreach ($this->data['users'] as $user):
                extract($user);
            ?>
                <tr>
                    <td>
                        <img src="<?php echo getenv('APP_DOMAIN'); ?>/storage/uploads/profile/<?php echo $image ?? 'default.png'; ?>"
                            alt="Foto de Perfil"
                            class="rounded-circle"
                            style="width: 30px; height: 30px; object-fit: cover; border: none; padding: 0;">

                        <a href="<?php echo getenv('APP_DOMAIN'); ?>/view-user/<?php echo $user['id']; ?>" class="user-link"><?php echo $name; ?></a>

                    </td>
                    <td><?php echo $created_at; ?></td>
                    <td class="text-center">
                        <span class="label label-default"><?php echo $status ?></span>
                    </td>
                    <td><?php echo $email; ?></td>
                    <td style="width: 20%;">
                        <a data-bs-toggle="modal" data-bs-target="#modalViewUser" data-user-id="<?php echo $user['id'] ?>" data-user-name="<?php echo $name; ?>" data-user-email="<?php echo $email ?>" data-user-updated="<?php echo $updated_at; ?>" data-user-created="<?php echo $created_at; ?>" class="table-link text-primary me-2">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a data-user-token="<?php echo $csrfEditUser; ?>" data-bs-toggle="modal" data-bs-target="#modalEditUser" data-user-id="<?php echo $user['id'] ?>" data-user-name="<?php echo $name; ?>" data-user-email="<?php echo $email ?>" class="table-link text-warning me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a data-user-token="<?php echo $csrfDeleteUser; ?>" data-bs-toggle="modal" data-bs-target="#modalDeleteUser" data-user-id="<?php echo $user['id'] ?>" class="table-link text-danger">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    include_once('./app/adms/Views/partials/pagination.php');

    ?>
<?php else: ?>
    <div class="alert alert-danger text-center" role="alert">
        <h4 class="mb-0">Usuário não Encontrado</h4>
    </div>
<?php endif; ?>