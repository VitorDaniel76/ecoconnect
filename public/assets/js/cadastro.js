const form = document.querySelector('.auth-form');

const nomeInput = document.querySelector('[name="nome"]');
const emailInput = document.querySelector('[name="email"]');
const senhaInput = document.querySelector('[name="senha"]');
const confirmarSenhaInput = document.querySelector('[name="confirmar-senha"]');

const nomeErro = document.querySelector('.nome-erro')
const emailErro = document.querySelector('.email-erro')
const senhaErro = document.querySelector('.password-erro');
const confirmarSenhaErro = document.querySelector('.confirm-password-erro');



function mostrarErro(elemento, mensagem){
    elemento.textContent = mensagem;

    elemento.classList.add('show');
}

function esconderErro(elemento){
    elemento.classList.remove('show')

    elemento.textContent = '';
}

form.addEventListener('submit', (e) =>{
    [nomeErro, emailErro, senhaErro, confirmarSenhaErro].forEach(esconderErro)

    const nome = nomeInput.value.trim();
    const email = emailInput.value.trim();
    const senha = senhaInput.value.trim();
    const confirmarSenha = confirmarSenhaInput.value.trim();

    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    let formularioValido = true;

    if (nome === ''){
        mostrarErro(nomeErro, 'Digite seu nome');

        formularioValido = false;
    }

    if (email === ''){
        mostrarErro(emailErro, 'Digite seu email');

        formularioValido = false;
    } else if (!emailValido){
        mostrarErro(emailErro, 'Email Inválido');

        formularioValido = false;
    }

    if (senha === ''){
        mostrarErro(senhaErro, 'Digite sua senha');

        formularioValido = false;
    }else if (senha.length < 6){
        mostrarErro(senhaErro, 'Senha deve ter pelo menos 6 caracteres');
        formularioValido = false;
    }

    if (confirmarSenha === ''){
        mostrarErro(confirmarSenhaErro, 'Confirme sua senha');

        formularioValido = false;
    }else if (senha !== confirmarSenha){
        mostrarErro(confirmarSenhaErro, 'Senha não é igual à confirmação');

        formularioValido = false;
    }

    if (!formularioValido){
        e.preventDefault();
    }

});


nomeInput.addEventListener('input', () =>{
    esconderErro(nomeErro);
});

emailInput.addEventListener('input', () =>{
    esconderErro(emailErro);
});

senhaInput.addEventListener('input', () =>{
    esconderErro(senhaErro);
});

confirmarSenhaInput.addEventListener('input', () =>{
    esconderErro(confirmarSenhaErro)
}); 