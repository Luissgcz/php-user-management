<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/css/styles.css">
    <link rel="stylesheet" href="<?php echo $_ENV['APP_DOMAIN']; ?>/public/adms/js/scripts.js">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


    <?php include('./app/adms/Views/partials/head.php') ?>
</head>

<body>
    <header>
        <?php include('./app/adms/Views/partials/navbar.php') ?>
        <?php include('./app/adms/Views/partials/menu.php') ?>

    </header>

    <?php include($this->view) ?>

    <footer>
        <?php include('./app/adms/Views/partials/footer.php') ?>
    </footer>
</body>

</html>