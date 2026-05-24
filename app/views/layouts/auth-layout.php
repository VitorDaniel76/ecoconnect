<?php 
    $title = $title ?? 'EcoConnect';
    $pageCss = $pageCss ?? '';
    $pageJs = $pageJs ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth-layout.css">
    <?php  if (!empty($pageCss)):?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/<?= $pageCss?>.css">

    <?php endif;?>

    <title><?=$title?></title>
</head>
<body>
    <main class="auth-container">
        <section class="auth-header">
            <div class="slogan">
                <img src="<?= BASE_URL ?>/assets/images/Reciclar-icone.png" alt="Icone_reciclar">
                <h1>ECOCONNECT</h1>
                <p>Conectando pessoas</p>
                <p>transformando o futuro.</p>
            </div>
            <picture>
                <img src="<?= BASE_URL ?>/assets/images/FundoInicial-desktop.png">
            </picture>
        </section>

        <?php if (!empty($page)) require $page; ?>

        <section class="auth-footer"></section>
    </main>

            <?php if (!empty($pageJs)): ?>
                <script src="<?= BASE_URL ?>/assets/js/<?= $pageJs ?>.js"></script>
            <?php endif; ?>
</body>
</html>
    