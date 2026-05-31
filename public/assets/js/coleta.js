document.addEventListener('DOMContentLoaded', () => {

    const form = document.querySelector('form');
    if (!form) return;


    // CAMPOS

    const fields = {
        material: {
            input: document.querySelectorAll('[name="id_tipo_material"]'),
            error: document.querySelector('.material-erro')
        },
        periodo: {
            input: document.querySelectorAll('[name="periodo"]'),
            error: document.querySelector('.periodo-erro')
        },
        quantidade: {
            input: document.querySelector('[name="quantidade"]'),
            error: document.querySelector('.quantidade-erro')
        },
        data: {
            input: document.querySelector('[name="data_coleta"]'),
            error: document.querySelector('.data-erro')
        },
        endereco: {
            input: document.querySelector('[name="endereco"]'),
            error: document.querySelector('.endereco-erro')
        },
        ponto: {
            input: document.querySelector('[name="ponto_referencia"]'),
            error: document.querySelector('.ponto-erro')
        },
        observacoes: {
            input: document.querySelector('[name="observacoes"]'),
            error: document.querySelector('.observacoes-erro')
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

    function radioSelecionado(list) {
        return [...list].some(r => r.checked);
    }


    // VALIDACAO SUBMIT

    form.addEventListener('submit', (e) => {

        let ok = true;

        Object.values(fields).forEach(f => {
            esconderErro(f.error);
        });

        // MATERIAL
        if (!radioSelecionado(fields.material.input)) {
            mostrarErro(fields.material.error, 'Selecione um tipo de material');
            ok = false;
        }

        // PERIODO
        if (!radioSelecionado(fields.periodo.input)) {
            mostrarErro(fields.periodo.error, 'Selecione o período');
            ok = false;
        }

        // QUANTIDADE
        const quantidade = fields.quantidade.input.value.trim();
        if (!quantidade) {
            mostrarErro(fields.quantidade.error, 'Informe a quantidade');
            ok = false;
        }

        // DATA
        const data = fields.data.input.value;
        if (!data) {
            mostrarErro(fields.data.error, 'Informe a data da coleta');
            ok = false;
        }

        // ENDEREÇO
        const endereco = fields.endereco.input.value.trim();
        if (!endereco) {
            mostrarErro(fields.endereco.error, 'Informe o endereço');
            ok = false;
        }

        if (!ok) {
            e.preventDefault();
        } else {
            const btn = form.querySelector('button');
            if (btn) btn.disabled = true;
        }
    });


    // LIMPAR ERRO AO INTERAGIR

    // radio material
    fields.material.input.forEach(r => {
        r.addEventListener('change', () => {
            esconderErro(fields.material.error);
        });
    });

    // radio periodo
    fields.periodo.input.forEach(r => {
        r.addEventListener('change', () => {
            esconderErro(fields.periodo.error);
        });
    });

    // inputs normais
    [fields.quantidade, fields.data, fields.endereco, fields.ponto, fields.observacoes]
        .forEach(f => {
            if (!f.input) return;

            f.input.addEventListener('input', () => {
                esconderErro(f.error);
            });
        });

});