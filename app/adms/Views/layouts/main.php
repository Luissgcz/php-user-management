<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./app/adms/Views/partials/head.php') ?>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>

        <div class="header_user">
            <p><?php echo $_SESSION['user'] ??  "" ?></p>
            <div class="header_img">
                <img src="<?php echo $_ENV['APP_DOMAIN'] ?>/public/adms/images/userimg.png" alt="UserIMG">
            </div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <?php include('./app/adms/Views/partials/navbar.php') ?>
    </div>


    <div class="content-main">
        <?php include($this->view) ?>
    </div>

</body>

</html>