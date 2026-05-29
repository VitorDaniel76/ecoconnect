<section class="home-section">
    <h2>Itens</h2>
    <form action="<?= BASE_URL ?>/home" method="GET" class="busca-form">
        <div class="busca-grupo">
            <input type="text" name="busca" placeholder="Buscar itens..." value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
            <button type="submit">
                <img src="<?= BASE_URL ?>/assets/images/pesquisar-icon.png" alt="Buscar">
            </button>
        </div>
    </form>

    <section class="categorias-section">

        <h2>Categorias</h2>
        <div class="lista-categorias">
            <a href="<?= BASE_URL?>/home" class="categoria-btn<?=  empty($categoriaAtual) ? ' ativo' : ''?>">
                Todos
            </a>
            <?php foreach($categorias as $categoria): ?>
                    <a href="<?= BASE_URL ?>/home?categoria=<?= $categoria->getId() ?>" class="categoria-btn<?= $categoriaAtual == $categoria->getId() ? ' ativo' : '' ?>">
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

                    <p class="item-categoria">Categoria: <?= $nomeCategoria ?></p>

                    <p class="item-condicao">Condição: <?= $item->getEstadoConservacao()?></p>

                    <p class="item-descricao"><?= $item->getDescricao()?></p>

                    <p class="item-localizacao"><img src="<?= BASE_URL?>/assets/images/location-icon.png ?>" alt=""> <?=  $item->getCidade() ?> - <?= $item->getEstado() ?></p>
                </div>

            </article>

        <?php endforeach; ?>

    </section>

    <div class="paginacao">

            <?php
                $buscaParam = trim($_GET['busca'] ?? '');
                $categoriaParam = trim($_GET['categoria'] ?? '');
            ?>

        <?php if($paginaAtualNumero > 1): ?>
            <a class="seta" href="?page=<?= $paginaAtualNumero -1 ?>&busca=<?= urlencode($buscaParam) ?>&categoria=<?= $categoriaParam ?>">
                &lt;
            </a>
        <?php endif; ?>
        
        <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="?page=<?= $i ?>&busca=<?= urlencode($buscaParam) ?>&categoria=<?= $categoriaParam ?>"
            class="<?=  $i == $paginaAtualNumero ? ' ativo' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if($paginaAtualNumero < $totalPaginas) : ?>
        <a class="seta" href="?page=<?= $paginaAtualNumero + 1 ?>&busca=<?= urlencode($buscaParam) ?>&categoria=<?= $categoriaParam ?>">
            &gt;
        </a>
        <?php endif; ?>
    </div>
</section>