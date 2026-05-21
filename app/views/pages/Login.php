<?php require __DIR__ . '/../components/auth-layout.php'?>

<section class="auth-form-section">
    <form class="auth-form" action="/ecoconnect/public/index.php?route=login" method="post">

    <div class="welcome">
        <h2>Bem-vindo!</h2>
        <p>Faça Login para continuar</p>
    </div>
        <div class="email-group">
            <label>Email</label>
            <div class="email-icon">
                <img src="/ecoconnect/public/assets/images/user-icon.png" alt="">
                <input placeholder="Digite seu email" type="email" name="email">
            </div>

        </div>

        <div class="password-group">
            <label>Senha</label>
            <div class="password-icon">
                <img class="cadeado-icon" src="/ecoconnect/public/assets/images/cadeado-icon.png" alt="">
                <img class="show-password-icon" src="/ecoconnect/public/assets/images/show-password.png" alt="">
                <input placeholder="Digite sua senha" type="password" name="senha">
            </div>

        </div>

        <button type="submit"> Entrar</button>
    </form>

    <div class="auth-redirect">
        <p>Não tem uma conta?</p>
        <a href="/ecoconnect/app/views/pages/Cadastro.php">Criar conta</a>
    </div>
</section>

<?php require __DIR__ . '/../components/auth-footer.php'?>