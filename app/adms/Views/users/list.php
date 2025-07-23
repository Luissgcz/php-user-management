<a href="<?php echo getenv('APP_DOMAIN'); ?>/create-user" class="btn btn-success">Criar Usuário</a>

<form id="filterForm" class="mb-3">
    <div class="row g-2">
        <div class="col">
            <input type="text" name="name" class="form-control" placeholder="Nome">
        </div>
        <div class="col">
            <input type="email" name="email" class="form-control" placeholder="E-mail">
        </div>
        <div class="col">
            <select name="status" class="form-select">
                <option value="">Todos os Status</option>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>
        <div class="col">
            <input type="submit" name="delete_user" class="btn btn-primary" value="Filtrar">
        </div>
    </div>
</form>

<div id="userTableContainer">
    <?php include(__DIR__ . '/tableUsers.php'); ?>
</div>

<?php include(__DIR__ . '/modalEditUser.php'); ?>
<?php include(__DIR__ . '/modalViewUser.php'); ?>
<?php include(__DIR__ . '/modalDeleteUser.php'); ?>