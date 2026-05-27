<section class="home-section">
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

            <a href="<?= BASE_URL ?>/home?categoria=<?= $categoria->getId() ?>" class="categoria-btn">
            <?= $categoria->getNome() ?>
            </a>

        <?php endforeach; ?>

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
            
                <img src="<?= $imagem ? $imagem->getUrlImagem() : BASE_URL . '/assets/default.jpg' ?>" alt="<?= $item->getTitulo() ?>">
                
                <div class="item-info">
                
                    <h2 class="item-titulo"> <?= $item->getTitulo() ?></h2>

                    <p class="item-categoria"> <?= $nomeCategoria ?>></p>

                    <p class="item-localizacao"> <?=  $item->getCidade() ?> - <?= $item->getEstado() ?></p>
                </div>

            </article>

        <?php endforeach; ?>

    </section>

</section>