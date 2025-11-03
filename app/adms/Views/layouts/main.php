<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./app/adms/Views/partials/head.php')
    ?>
</head>


<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>

        <div class="header_user">
            <p><?php echo $_SESSION['user'] ??  "" ?></p>
            <div class="header_img">
                <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/view-user/<?php echo $_SESSION['userId'] ?>">
                    <img src="<?php echo $_ENV['APP_DOMAIN'] ?>/storage/uploads/profile/<?php echo $this->data['userLogin']['image'] ?? 'default.png' ?>" alt="UserIMG">
                </a>
            </div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <?php include('./app/adms/Views/partials/navbar.php');
        ?>

    </div>


    <div class="content-main">
        <?php include($this->view) ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/navbar/bootstrap.bundle.min.js"></script>

    <script src="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/navbar/navbar.js"></script>
    <script src="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/listUsers/modalAction.js"></script>
    <script src="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/listUsers/filterUsers.js"></script>
    <script src="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/dashboard/filterUsersMsg.js"></script>
</body>

</html>