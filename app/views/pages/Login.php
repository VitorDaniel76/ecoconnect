<?php $title = 'Login';
$pageCss = 'login';
$pageJs = 'login';
?>

<?php require __DIR__ . '/../layouts/auth-layout.php'?>

<section class="auth-form-section">
    <form class="auth-form" action="<?= BASE_URL ?>/login" method="post" novalidate>

    <div class="welcome">
        <h2>Bem-vindo!</h2>
        <p>Faça Login para continuar</p>
    </div>
        <div class="email-group">
            <label>Email</label>
            <div class="email-icon">
                <img src="<?= BASE_URL ?>/assets/images/user-icon.png" alt="">
                <input placeholder="Digite seu email" type="email" name="email">
            </div>
            <label class="email-erro"></label>

        </div>

        <div class="password-group">
            <label>Senha</label>
            <div class="password-icon">
                <img class="cadeado-icon" src="<?= BASE_URL ?>/assets/images/cadeado-icon.png" alt="">
                <img class="show-password-icon" src="<?= BASE_URL ?>/assets/images/show-password.png" alt="">
                <input placeholder="Digite sua senha" type="password" name="senha">
            </div>
            <label class="password-erro"></label>

        </div>

        <button type="submit"> Entrar</button>
    </form>

    <div class="auth-redirect">
        <p>Não tem uma conta?</p>
        <a href="<?= BASE_URL ?>/telaCadastro">Criar conta</a>
    </div>
</section>

<?php require __DIR__ . '/../components/auth-footer.php'?>