<?php
$paginaAtual = $paginaAtual ?? '';

$navItems = [
    'home' => 'Home',
    'item' => 'Itens',
    'publicar' => 'Publicar',
    'coleta' => 'Coleta',
    'perfil' => 'Perfil',
];
?>

<nav class="bottom-nav">

    <?php foreach($navItems as $key => $label): ?>
        <a href="<?= BASE_URL ?>/<?= $key ?>"
           class="nav-item<?= $paginaAtual == $key ? ' ativo' : '' ?>">

            <img src="<?= BASE_URL ?>/assets/images/<?= $key ?>-icon<?= $paginaAtual == $key ? '-ativo' : '' ?>.png" alt="">

            <span><?= $label ?></span>

        </a>
    <?php endforeach; ?>

</nav>
