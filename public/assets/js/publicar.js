document.addEventListener('DOMContentLoaded', () => {

    const form = document.querySelector('.publicar-form');
    if (!form) return;

    // =========================
    // CAMPOS
    // =========================
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
            input: document.querySelector('[name="imagens[]"]'),
            error: document.querySelector('.imagem-erro')
        }
    };

    // =========================
    // HELPERS
    // =========================
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

    // =========================
    // PREVIEW IMAGENS
    // =========================
    const inputImagem = fields.imagem.input;
    if (!inputImagem) return;

    const preview = document.createElement('div');
    preview.classList.add('preview-imagens');

    inputImagem.closest('.input-group')?.appendChild(preview);

    inputImagem.addEventListener('change', (e) => {

        preview.innerHTML = '';

        const files = Array.from(e.target.files);

        if (files.length > 4) {
            mostrarErro(fields.imagem.error, 'Você pode enviar no máximo 4 imagens');
            inputImagem.value = '';
            return;
        }

        if (files.length === 0) return;

        const tiposValidos = ['image/jpeg', 'image/png', 'image/webp'];

        files.forEach(file => {

            if (!tiposValidos.includes(file.type)) {
                mostrarErro(fields.imagem.error, 'Formato de imagem inválido');
                return;
            }

            const reader = new FileReader();

            reader.onload = (event) => {

                const img = document.createElement('img');
                img.src = event.target.result;

                img.style.width = '80px';
                img.style.height = '80px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '8px';
                img.style.marginRight = '6px';

                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        });

        esconderErro(fields.imagem.error);
    });

    // =========================
    // VALIDACAO SUBMIT
    // =========================
    form.addEventListener('submit', (e) => {

        let ok = true;

        Object.values(fields).forEach(f => {
            esconderErro(f.error);
        });

        const titulo = fields.titulo.input.value.trim();
        const descricao = fields.descricao.input.value.trim();
        const categoria = fields.categoria.input.value;
        const estadoConservacao = fields.estadoConservacao.input.value;
        const cidade = fields.cidade.input.value.trim();
        const estado = fields.estado.input.value;
        const imagens = inputImagem.files;

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

        if (!imagens || imagens.length === 0) {
            mostrarErro(fields.imagem.error, 'Envie pelo menos uma imagem');
            ok = false;
        }

        if (!ok) {
            e.preventDefault();
            return;
        }

        const btn = form.querySelector('button');
        if (btn) btn.disabled = true;
    });

    // =========================
    // LIMPAR ERRO AO DIGITAR
    // =========================
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