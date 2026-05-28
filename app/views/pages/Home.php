<section class="home-section">
    <h2>Itens</h2>
    <form action="<?= BASE_URL ?>/home" method="GET" class="busca-form">
        <div class="busca-grupo">
            <input type="text" name="busca" placeholder="Buscar itens...">
            <button type="submit">
                <img src="<?= BASE_URL ?>/assets/images/pesquisar-icon.png" alt="Buscar">
            </button>
        </div>
    </form>

    <section class="categorias-section">

        <h2>Categorias</h2>
        <div class="lista-categorias">
            <a href="<?= BASE_URL?>/home" class="categoria-btn<?=  empty($categoriaAtual) ? '-ativo' : ''?>">
                Todas
            </a>
            <?php foreach($categorias as $categoria): ?>
                    <a href="<?= BASE_URL ?>/home?categoria=<?= $categoria->getId() ?>" class="categoria-btn<?= $categoriaAtual == $categoria->getId() ? '-ativo' : '' ?>">
                    <?= $categoria->getNome() ?>
                    </a>

            <?php endforeach; ?>
        </div>

    </section>

    <section class="itens-section">
        <?php foreach($itens as $item):?>
            <?php 
                $imagem = $item->getImagens()[0] ?? null;

                $nomeCategoria = '';

                foreach($categorias as $categoria){
                    if($categoria->getId() === $item->getIdCategoria()){
                        $nomeCategoria = $categoria->getNome();
                        break;
                    }
                }
            ?>
            <article class="item-card">
            
                <img class="item-card-imagem" src="<?= $imagem ? $imagem->getUrlImagem() : BASE_URL . '/assets/default.jpg' ?>" alt="<?= $item->getTitulo() ?>">
                
                <div class="item-info">
                
                    <h2 class="item-titulo"> <?= $item->getTitulo() ?></h2>

                    <p class="item-descricao"><?= $item->getDescricao()?></p>

                    <p class="item-categoria">Categoria: <?= $nomeCategoria ?></p>

                    <p class="item-localizacao"><img src="<?= BASE_URL?>/assets/images/location-icon.png ?>" alt=""> <?=  $item->getCidade() ?> - <?= $item->getEstado() ?></p>
                </div>

            </article>

        <?php endforeach; ?>

    </section>

</section>