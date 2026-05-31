<div class="mensagens-container">

    <h2>Suas conversas</h2>

    <?php if (empty($chats)): ?>
        <p class="sem-chats">Você ainda não tem conversas.</p>
    <?php endif; ?>

    <?php foreach ($chats as $chat): ?>

        <a class="chat-item"
           href="<?= BASE_URL ?>/mensagens/abrir?id=<?= $chat['id_conversa'] ?>">

            <div class="chat-info">

                <div class="chat-nome">
                    <?= htmlspecialchars($chat['usuario']->getNome()) ?>
                </div>

                <div class="chat-ultima-msg">
                    <?= htmlspecialchars($chat['ultima_mensagem']) ?>
                </div>

            </div>

            <div class="chat-data">
                <?= date('d/m H:i', strtotime($chat['data'])) ?>
            </div>

        </a>

    <?php endforeach; ?>

</div>