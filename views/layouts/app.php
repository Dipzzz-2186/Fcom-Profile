<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($site['company']['name']) ?> | Company Profile</title>
    <link rel="icon" type="image/png" href="/public/assets/img/logo2.png">
    <link rel="shortcut icon" href="/public/assets/img/logo2.png">
    <link rel="apple-touch-icon" href="/public/assets/img/logo2.png">
    <link rel="stylesheet" href="/public/assets/css/site.css">
</head>
<body class="page-shell is-loading">
    <div class="site-intro" aria-hidden="true">
        <div class="site-intro-inner">
            <div class="site-intro-mark">
                <img src="/public/assets/img/fcom.png" alt="">
            </div>
            <div class="site-intro-line"></div>
            <p class="site-intro-copy">Integrated Technology Solutions</p>
        </div>
    </div>
    <?= $content ?>
    <script src="/public/assets/js/site.js"></script>
</body>
</html>
