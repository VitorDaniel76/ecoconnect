<section class="coleta-section">
    <div class="coleta-header">
        <h2>Agendar Coleta</h2>
        <p>Preencha os dados para agendar a coleta de recicláveis</p>
    </div>
    <form action="<?= BASE_URL ?>/coleta" method="POST" novalidate>

            <p class="texto">Tipo de item</p>
            <div class="materiais">
                <?php foreach($materiais as $m):?>
                    <label class="material">
                        <input class="radio-material" type="radio" name="id_tipo_material" value="<?= $m->getId() ?>">
                        <div class="box">
                            <?php
                            $imagensMateriais = [
                                1 => 'papel-icon.png',
                                2 => 'plastico-icon.png',
                                3 => 'metal-can.png',
                                4 => 'vidro-icon.png',
                                5 => 'eletronico-icon.png',
                                6 => 'Organico-icon.png'
                                ];

                                $img = $imagensMateriais[$m->getId()] ?? 'default.png';
                            ?>
                            <img src="<?= BASE_URL ?>/assets/images/<?= $img ?>" alt="<?=  $m->getNome() ?>">

                            <span><?=  $m->getNome() ?></span>
                        </div>
                    </label>
                <?php endforeach; ?>
                <div class="material-erro erro"></div>
            </div>

                <div class="campo">
                    <label class="texto" for="quantidade">Quantidade</label>
                    <input type="text" id="quantidade" name="quantidade" placeholder="Ex: 2 sacos, 5kg" required>
                    <p class="quantidade-erro erro"></p>
                </div>

                <div class="data-coleta">
                    <div class="campo">
                        <label class="texto" for="data_coleta">Data da coleta</label>
                        <input type="date" id="data_coleta" name="data_coleta" placeholder="Selecione a data" required>
                        <p class="data-erro erro"></p>
                    </div>

                    <div class="campo">
                        <label class="texto" for="periodo">Período</label>
                        <div class="opcoes-periodo">

                            <label class="periodo">
                                <input type="radio" name="periodo" value="tarde">
                                <div class="box texto">Tarde (12h -18h)</div>
                            </label>

                            <label class="periodo">
                                <input type="radio" name="periodo" value="noite">
                                <div class="box texto">Noite (18h - 21h)</div>
                            </label>

                        </div>
                        <p class="periodo-erro erro"></p>
                    </div>
                </div>

                <div class="campo">
                    <label class="texto" for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" placeholder="Digite seu endereço" required>
                    <p class="endereco-erro erro"></p>
                </div>

                <div class="campo">
                    <label class="texto" for="ponto_referencia">Ponto de referência (opcional)</label>
                    <input type="text" id="ponto_referencia" placeholder="Ex: Próximo ao mercado, padaria, etc..." name="ponto_referencia">
                </div>

                <div class="campo">
                    <label class="texto" for="observacoes">Observações (opcional)</label>
                    <textarea id="observacoes" name="observacoes" placeholder="Alguma observação?"></textarea>
                </div>

                <button type="submit">
                    Confirmar Agendamento
                </button>


    </form>
</section>