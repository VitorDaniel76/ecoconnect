<?php $paginaAtual = $paginaAtual ?? '';?>

<?php $navItems = [
    'home' => 'Home',
    'coleta' => 'Coleta',
    'publicar' => 'Publicar',
    'ecoponto' => 'Ecoponto',
    'perfil' => 'Perfil',
    'mensagens' => 'Mensagem'
];?>

<nav class="sidebar-nav">
    <div class="sidebar-logo">
        <img src="<?= BASE_URL ?>/assets/images/Reciclar-icone.png" alt="Icone_reciclar">
        <h2>ECOCONNECT</h2>
    </div>
    <div class="sidebar-links">
        <?php foreach($navItems as $key => $label): ?>
            <a href="<?= BASE_URL ?>/<?= $key ?>"
            class="sidebar-nav-item<?= $paginaAtual == $key ? ' ativo' : '' ?>">

                <img src="<?= BASE_URL ?>/assets/images/<?= $key ?>-icon<?= $paginaAtual == $key ? '-ativo' : '' ?>.png" alt="">

                <span><?= $label ?></span>

            </a>
        <?php endforeach; ?>
    </div>

    <a href="<?= BASE_URL ?>/logout" class="sidebar-logout">
        <img src="<?= BASE_URL ?>/assets/images/logout-icon.png" alt="">
        <span>Sair</span>
    </a>

</nav>
