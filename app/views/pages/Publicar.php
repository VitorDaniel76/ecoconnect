<section class="publicar-section">
    <form class="publicar-form" action="<?= BASE_URL ?>/publicar" method="POST" enctype="multipart/form-data">
        <div class= "input-group">
            <label>Imagem</label>
            <input type="file" name="imagem" required>
        </div>

        <div class="input-group">
            <label>Nome do Item</label>

            <input type="text" name="titulo" required>
        </div>

        <div class="input-group"> 
            <label>Descrição</label>
            <textarea name="descricao" required></textarea>
        </div>

        <div class="input-group">
            <label>Categoria</label>

            <select name="categoria" required>

                <?php foreach($categorias as $categoria):?>
                    <option value="<?=  $categoria->getId() ?>">
                        <?= $categoria->getNome() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group">
            <label>Estado de Conservação</label>

            <select name="estado_conservacao" required>
                <option value="Novo">Novo</option>
                <option value="Semi-novo">Semi-novo</option>
                <option value="Usado">Usado</option>
            </select>
        </div>

        <div class="input-group">
            <label>Cidade</label>

            <input type="text" name="cidade" required>
        </div>

        <div class="input-group">
            <label>Estado</label>

            <select name="estado">
                <?php foreach ($estados as $sigla => $nome):?>
                    <option value="<?= $sigla ?>">
                        <?= $nome ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group">
            <label>Endereço</label>

            <input type="text" name="endereco">
        </div>

        <button type="submit" onclick="this.disabled=true; this.form.submit();">Publicar Item</button>
    </form>
</section>