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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/app-layout.css">
    
    <?php if(!empty($pageCss)): ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/<?= $pageCss ?>.css">
    <?php endif; ?>

    <title><?= $title?></title>
</head>
<body>
    <a href="<?= BASE_URL ?>/mensagens" class="chat-float">
        <img src="<?= BASE_URL ?>/assets/images/mensagens-icon-ativo.png" alt="">
    </a>
    <div class="app-layout">
        <?php require __DIR__ . '/../components/sidebar.php';?>
        
        <main class="app-content">
            <?php if (!empty($page)) require $page; ?>
        </main>

        <?php require __DIR__ . '/../components/bottom-nav.php';?>

    </div>

    <?php if (!empty($pageJs)): ?>
    <script src="<?= BASE_URL ?>/assets/js/<?= $pageJs ?>.js"></script>
    <?php endif; ?>
    
</body>
</html>