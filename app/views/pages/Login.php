<?php require __DIR__ . '/../components/auth-layout.php'?>

<section class="auth-form-section">
    <form class="auth-form" action="index.php?route=login" method="post">
        <div class="email-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>

        <div class="password-group">
            <label>Senha</label>
            <input type="password" name="senha">
        </div>

        <button type="submit"> Entrar</button>
    </form>

    <div class="auth-redirect">
        <p>Não tem uma conta?</p>
        <a href="/app/views/pages/Cadastro.php">Criar conta</a>
    </div>
</section>

<?php require __DIR__ . '/../components/auth-footer.php'?>