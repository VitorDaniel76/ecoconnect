<section class="publicar-section">

    <h2>Novo Item</h2>
    
    <form class="publicar-form" action="<?= BASE_URL ?>/publicar" method="POST" enctype="multipart/form-data" novalidate>
        <div class= "input-group foto">
            <label>Foto do Item</label>
            <label class="foto-area">
                <input type="file" name="imagens[]" multiple required>
                <img src="<?= BASE_URL ?>/assets/images/camera-icon.png" alt="">
                <span>Adicionar Foto</span>
            </label>
            <span class="error imagem-erro"></span>
        </div>

        <div class="input-group nome">
            <label>Nome do Item</label>

            <input type="text" name="titulo" required placeholder="Ex: Cadeira de Madeira">

            <span class="error nome-erro"></span>
        </div>

        <div class="input-group descricao"> 
            <label>Descrição</label>
            <textarea name="descricao" required placeholder="Descreva seu Item..."></textarea>
            <span class="error descricao-erro"></span>
        </div>

        <div class="input-group categoria">
            <label>Categoria</label>

            <select name="categoria" required>
                <option value="">Selecione uma categoria</option>
                <?php foreach($categorias as $categoria):?>
                    <option value="<?=  $categoria->getId() ?>">
                        <?= $categoria->getNome() ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <span class="error categoria-erro"></span>
        </div>

        <div class="input-group estado-conservacao">
            <label>Estado de Conservação</label>

            <select name="estado-conservacao" required>
                <option value="">Selecione</option>
                <option value="Novo">Novo</option>
                <option value="Semi-novo">Semi-novo</option>
                <option value="Usado">Usado</option>
            </select>
            <span class="error estado-conservacao-erro"></span>
        </div>

        <div class="input-group estado">
            <label>Estado</label>

            <select name="estado">
                <option value="">Selecione um estado</option>
                <?php foreach ($estados as $sigla => $nome):?>
                    <option value="<?= $sigla ?>">
                        <?= $nome ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span class="error estado-erro"></span>
        </div>

        <div class="input-group cidade">
            <label>Cidade</label>

            <input type="text" name="cidade" required placeholder="Ex: São Paulo">

            <span class="error cidade-erro"></span>
        </div>


        <button type="submit">Publicar Item</button>
    </form>
</section>