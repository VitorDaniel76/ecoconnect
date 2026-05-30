<section class="item-section">
    <div class="imagem-section">
        <div class="galeria">
            <button class="btn-anterior">
                &lt;
            </button>

            <img id="imagemPrincipal" src="<?= $imagens[0]->getUrlImagem() ?>" alt="<?= $item->getTitulo() ?>">

            <button class="btn-proximo">
                &gt;
            </button>
        </div>
        <div class="miniaturas">
            <?php foreach($imagens as $imagem):?>
                <img src="<?= $imagem->getUrlImagem() ?>" alt="">
            <?php endforeach; ?>
        </div>
    </div>
    <div class="infos">
        <h2><?= $item->getTitulo() ?></h2>
        <p class="item-localizacao"><img src="<?= BASE_URL?>/assets/images/location-icon.png ?>" alt=""> <?=  $item->getCidade() ?> - <?= $item->getEstado() ?></p>
        <p class="item-descricao"><?= $item->getDescricao()?></p>

        <div class="categoria-info">
            <div class="icone">
                <img src="<?= BASE_URL ?>/assets/images/categoria-icon.png" alt="">
            </div>
            <div class="texto">
                <p>Categoria</p>
                <p><?= $categoriaNome ?></p>
            </div>
        </div>

        <div class="condicao-info">
            <div class="icone">
                <img src="<?= BASE_URL ?>/assets/images/estado-conservacao-icon.png" alt="">
            </div>
            <div class="texto">
                <p>Estado de Conservação</p>
                <p><?= $item->getEstadoConservacao() ?></p>
            </div>
        </div>

        <div class="data-info">
            <div class="icone">
                <img src="<?= BASE_URL ?>/assets/images/data-icon.png" alt="">
            </div>
            <div class="texto">
                <p>Publicado em</p>
                <p><?= $dataPublicacao ?></p>
            </div>
        </div>
        
        <div class="proprietario-info">
            <p>Sobre o proprietário</p>
            <div class="proprietario">
                <img src="<?= $usuarioFoto ?: BASE_URL . '/assets/images/default-user.png' ?>" alt="">
                <div class="nome-data">
                    <p><?= $usuarioNome ?></p>
                    <p>Membro desde <?= $usuarioData?></p>
                </div>
            </div>
            <button class="btn-mensagem">Enviar Mensagem</button>
        </div>

    </div>

</section>