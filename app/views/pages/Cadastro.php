<?php $title = 'Cadastro';
$pageCss = 'Cadastro';
?>

<?php require __DIR__ . '/../components/auth-layout.php'?>

<section class="auth-form-section">
    <form class="auth-form" action="/ecoconnect/public/index.php?route=cadastrar" method="post" novalidate>

        <div class="criar-conta-mensagem">
            <h2>Criar Conta!</h2>
            <p>Preencha os dados abaixo para cria suar conta</p>
        </div>

        <div class="nome-group">
            <label>Nome</label>
            <div class="nome-icon">
                <img src="/ecoconnect/public/assets/images/user-icon.png" alt="">
                <input placeholder="Digite seu nome" type="text" name="nome">
            </div>
        </div>

        <div class="email-group">
            <label>Email</label>
            <div class="email-icon">
                <img src="/ecoconnect/public/assets/images/user-icon.png" alt="">
                <input placeholder="Digite seu email" type="email" name="email">
            </div>
            <label class="email-erro"></label>
        </div>

        <div class="password-group">
            <div class="password">
                <label>Senha</label>
                <div class="password-icon">
                    <img class="cadeado-icon" src="/ecoconnect/public/assets/images/cadeado-icon.png" alt="">
                    <img class="show-password-icon" src="/ecoconnect/public/assets/images/show-password.png" alt="">
                    <input placeholder="Digite sua senha" type="password" name="senha">
                </div>
                <label class="password-erro"></label>
            </div>

            <div class="confirm-password">
                <label>Confirmar senha</label>
                <div class="confirm-password-icon">
                    <img class="cadeado-icon" src="/ecoconnect/public/assets/images/cadeado-icon.png" alt="">
                    <img class="show-password-icon" src="/ecoconnect/public/assets/images/show-password.png" alt="">
                    <input placeholder="Confirme sua senha" type="password" name="confirmar_senha">
                </div>
            </div>
        </div>

        <button type="submit">Cadastrar</button>
    </form>

    <div class="auth-redirect">
        <p>Já tem uma conta?</p>
        <a href="index.php?route=telaLogin">Entrar</a>
    </div>
</section>

<?php require __DIR__ . '/../components/auth-footer.php'?>