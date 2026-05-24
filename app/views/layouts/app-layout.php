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
    <link rel="stylesheet" href="/ecoconnect/public/assets/css/global.css">
    <link rel="stylesheet" href="/ecoconnect/public/assets/css/app-layout.css">
    
    <?php if($pageCss): ?>
        <link rel="stylesheet" href="/ecoconnect/public/assets/css/<?= $pageCss ?>.css">
    <?php endif; ?>
    <title><?= $title ?? 'EcoConnect' ?></title>
</head>
<body>
    <div class="app-layout">
        <?php require __DIR__ . '/../components/sidebar.php';?>

        <?php require __DIR__ . '/../components/bottom-nav.php';?>

        <?php require __DIR__ . '/../pages/Home.php';?>

    </div>
</body>
</html>