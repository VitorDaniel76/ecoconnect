document.addEventListener('DOMContentLoaded', () => {

    const form = document.querySelector('.publicar-form');

    if (!form) return;

    // CAMPOS
    const fields = {
        titulo: {
            input: document.querySelector('[name="titulo"]'),
            error: document.querySelector('.nome-erro')
        },
        descricao: {
            input: document.querySelector('[name="descricao"]'),
            error: document.querySelector('.descricao-erro')
        },
        categoria: {
            input: document.querySelector('[name="categoria"]'),
            error: document.querySelector('.categoria-erro')
        },
        estadoConservacao: {
            input: document.querySelector('[name="estado-conservacao"]'),
            error: document.querySelector('.estado-conservacao-erro')
        },
        cidade: {
            input: document.querySelector('[name="cidade"]'),
            error: document.querySelector('.cidade-erro')
        },
        estado: {
            input: document.querySelector('[name="estado"]'),
            error: document.querySelector('.estado-erro')
        },
        imagem: {
            input: document.querySelector('[name="imagem"]'),
            error: document.querySelector('.imagem-erro')
        }
    };

    // HELPERS
    function mostrarErro(el, msg) {
        if (!el) return;
        el.textContent = msg;
        el.classList.add('show');
    }

    function esconderErro(el) {
        if (!el) return;
        el.textContent = '';
        el.classList.remove('show');
    }

    // SUBMIT
    form.addEventListener('submit', (e) => {

        let ok = true;

        // limpa erros
        Object.values(fields).forEach(f => {
            esconderErro(f.error);
        });

        const titulo = fields.titulo.input?.value.trim();
        const descricao = fields.descricao.input?.value.trim();
        const categoria = fields.categoria.input?.value;
        const estadoConservacao = fields.estadoConservacao.input?.value;
        const cidade = fields.cidade.input?.value.trim();
        const estado = fields.estado.input?.value;
        const imagem = fields.imagem.input?.files?.[0];

        // validações
        if (!titulo) {
            mostrarErro(fields.titulo.error, 'Digite o nome do item');
            ok = false;
        }

        if (!descricao) {
            mostrarErro(fields.descricao.error, 'Digite a descrição');
            ok = false;
        } else if (descricao.length < 10) {
            mostrarErro(fields.descricao.error, 'Descrição muito curta');
            ok = false;
        }

        if (!categoria) {
            mostrarErro(fields.categoria.error, 'Selecione uma categoria');
            ok = false;
        }

        if (!estadoConservacao) {
            mostrarErro(fields.estadoConservacao.error, 'Selecione o estado de conservação');
            ok = false;
        }

        if (!cidade) {
            mostrarErro(fields.cidade.error, 'Digite a cidade');
            ok = false;
        }

        if (!estado) {
            mostrarErro(fields.estado.error, 'Selecione o estado');
            ok = false;
        }

        if (!imagem) {
            mostrarErro(fields.imagem.error, 'Envie uma imagem');
            ok = false;
        } else {
            const tiposValidos = ['image/jpeg', 'image/png', 'image/webp'];

            if (!tiposValidos.includes(imagem.type)) {
                mostrarErro(fields.imagem.error, 'Formato inválido');
                ok = false;
            }
        }

        // bloqueia envio se inválido
        if (!ok) {
            e.preventDefault();
            return;
        }

        // evita double submit
        const btn = form.querySelector('button');
        if (btn) btn.disabled = true;
    });

    // LIMPAR ERRO AO DIGITAR
    Object.values(fields).forEach(f => {

        if (!f.input || !f.error) return;

        if (f.input.type === 'file') {
            f.input.addEventListener('change', () => {
                esconderErro(f.error);
            });
        } else {
            f.input.addEventListener('input', () => {
                esconderErro(f.error);
            });
        }
    });

});