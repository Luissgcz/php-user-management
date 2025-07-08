<nav class="nav">
    <div>
        <a href="#" class="nav_logo">
            <i class='bx bx-layer nav_logo-icon'></i>
            <span class="nav_logo-name">ARCH MVC</span>
        </a>

        <div class="nav_list">
            <a href="<?php echo $_ENV['APP_DOMAIN'] ?>/dashboard" class="nav_link active">
                <i class='bx bx-grid-alt nav_icon'></i>
                <span class="nav_name">Dashboard</span>
            </a>
            <a href="<?php echo $_ENV['APP_DOMAIN'] ?>/list-users" class="nav_link">
                <i class='bx bx-user nav_icon'></i>
                <span class="nav_name">Usuários</span>
            </a>
            <a href="<?php echo $_ENV['APP_DOMAIN'] ?>/create-user" class="nav_link">
                <i class='bx bx-user-plus nav_icon'></i>
                <span class="nav_name">Criar Usuário</span>
            </a>
            <a href="<?php echo $_ENV['APP_DOMAIN'] ?>/edit-password" class="nav_link">
                <i class='bx bx-lock nav_icon'></i>
                <span class="nav_name">Alterar Senha</span>
            </a>
        </div>

    </div>

    <a href="<?php echo $_ENV['APP_DOMAIN'] ?>/logout" class="nav_link">
        <i class='bx bx-log-out nav_icon'></i>
        <span class="nav_name">Sair</span>
    </a>
</nav>