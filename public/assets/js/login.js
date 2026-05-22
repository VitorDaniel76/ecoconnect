const form = document.querySelector('.auth-form');

const emailInput = document.querySelector('[name="email"]');
const passwordInput = document.querySelector('[name="senha"]');

const emailErro = document.querySelector('.email-erro');
const passwordErro = document.querySelector('.password-erro')

function mostrarErro(elemento, mensagem){
    elemento.textContent = mensagem;

    elemento.classList.add('show');
}

function esconderErro(elemento){
    elemento.classList.remove('show')

    elemento.textContent = '';
}

form.addEventListener('submit', (e) =>{
    esconderErro(emailErro);
    esconderErro(passwordErro);

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    let formularioValido = true;

    if(email === ''){
        mostrarErro(emailErro, 'Digite seu email');

        formularioValido = false;

    }else if (!emailValido){
        mostrarErro(emailErro, 'Email inválido');

        formularioValido = false;
    }

    if(password === ''){
        mostrarErro(passwordErro, 'Digite sua senha');

        formularioValido = false;
    }
    if(!formularioValido){
        e.preventDefault();
    }
});

emailInput.addEventListener('input', () =>{
    esconderErro(emailErro);
});

passwordInput.addEventListener('input', () =>{
    esconderErro(passwordErro);
});