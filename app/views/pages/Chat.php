<div class="chat-container">

    <div class="chat-header">

        <a href="<?= BASE_URL ?>/mensagens" class="btn-voltar">
            ← Voltar
        </a>

        <div class="chat-user">
            <img src="<?= $usuarioFoto ?? BASE_URL . '/assets/images/default-user.png' ?>" alt="user">

            <div class="chat-user-info">
                <strong><?= htmlspecialchars($usuarioNome ?? 'Usuário') ?></strong>
            </div>
        </div>

    </div>


    <div class="chat-messages">

        <?php if (!empty($mensagens)): ?>

            <?php foreach ($mensagens as $msg): ?>

                <div class="message <?= $msg->getIdRemetente() == $_SESSION['id_usuario'] ? 'mine' : 'theirs' ?>">

                    <div class="bubble">
                        <?= htmlspecialchars($msg->getMensagem()) ?>
                    </div>

                    <div class="time">
                        <?= date('H:i', strtotime($msg->getDataEnvio())) ?>
                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="no-messages">Nenhuma mensagem ainda. Inicie a conversa 👋</p>

        <?php endif; ?>

    </div>

    <form class="chat-input" action="<?= BASE_URL ?>/mensagens/enviar" method="POST">

        <input type="hidden" name="id_conversa" value="<?= $idConversa ?>">

        <input type="text" name="mensagem" placeholder="Digite sua mensagem..." autocomplete="off">

        <button type="submit">Enviar</button>

    </form>

</div>