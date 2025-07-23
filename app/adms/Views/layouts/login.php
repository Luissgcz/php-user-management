<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./app/adms/Views/partials/head.php') ?>
    <title> <?php echo $this->data['head'] ?></title>
    <link rel="stylesheet" href="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/fonts/icomoon/style.css" />
    <link rel="stylesheet" href="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/css/login/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/css/login/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/css/login/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

</head>

<body>
    <?php include($this->view) ?>
    <script src="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/js/login/jquery-3.3.1.min.js"></script>
    <script src="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/js/login/popper.min.js"></script>
    <script src="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/js/login/bootstrap.min.js"></script>
    <script src="<?php echo getenv('APP_DOMAIN'); ?>/public/adms/js/login/main.js"></script>
</body>

</html>