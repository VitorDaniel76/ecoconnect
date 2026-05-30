const imagemPrincipal = document.getElementById('imagemPrincipal');

const btnAnterior = document.querySelector('.btn-anterior');
const btnProximo = document.querySelector('.btn-proximo');

const miniaturas = document.querySelectorAll('.miniaturas img');

let indiceAtual = 0;

function AtualizarImagem(){
    imagemPrincipal.src = miniaturas[indiceAtual].src;
}

btnProximo.addEventListener('click', () =>{
        indiceAtual++;

        if (indiceAtual >= miniaturas.length){
            indiceAtual = 0
        }

        AtualizarImagem();
});

btnAnterior.addEventListener('click', () =>{
    indiceAtual--;

    if (indiceAtual < 0){
        indiceAtual = miniaturas.length -1;
    }

    AtualizarImagem();
});

miniaturas.forEach((miniatura, index) =>{
    miniatura.addEventListener('click', () => {
        indiceAtual = index;
        AtualizarImagem();
    });
});