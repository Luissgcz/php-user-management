<link rel="stylesheet" href="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/css/navbar/navbar.css" />
<script defer src="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/navbar/bootstrap.bundle.min.js"></script>
<script defer src="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/navbar/jquery-3.3.1.min.js"></script>
<script defer src="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/navbar/navbar.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

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
            <a href="<?php echo $_ENV['APP_DOMAIN'] ?>/view-user" class="nav_link">
                <i class='bx bx-user nav_icon'></i>
                <span class="nav_name">Usuários</span>
            </a>
            <a href="<?php echo $_ENV['APP_DOMAIN'] ?>/edit-password" class="nav_link">
                <i class='bx bx-lock nav_icon'></i>
                <span class="nav_name">Alterar Senha</span>
            </a>
            <!-- <a href="#" class="nav_link">
                        <i class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Messages</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Bookmark</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">Files</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Stats</span>
                    </a> -->
        </div>
    </div>

    <a href="<?php echo $_ENV['APP_DOMAIN'] ?>/logout" class="nav_link">
        <i class='bx bx-log-out nav_icon'></i>
        <span class="nav_name">Sair</span>
    </a>
</nav>