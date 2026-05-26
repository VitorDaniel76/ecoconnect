<section class="home-content">
    <form action="<?= BASE_URL ?>/home" method="GET" class="busca-form">
        <div class="busca-grupo">
            <input type="text" name="busca" placeholder="Buscar itens...">
            <button type="submit">
                <img src="<?= BASE_URL ?>/assets/images/pesquisar-icon.png" alt="Buscar">
            </button>
        </div>
    </form>

    <section class="categorias-section">

        <?php foreach($categorias as $categoria): ?>

            <a href="<?= BASE_URL ?>/home?categoria<?= $categoria->getId() ?>" class="categoria-btn">
            <?= $categoria->getNome() ?>
            </a>

        <?php endforeach; ?>

    </section>

    <section class="itens=section">
        <?php foreach($itens as $item):?>

            <article class="item-card">

            <div class="item-info"></div>

            </article>

    </section>

</section>