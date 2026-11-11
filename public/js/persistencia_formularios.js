document.addEventListener('DOMContentLoaded', function () {

    const formularios = document.querySelectorAll('form');

    formularios.forEach((formulario, indice) => {

        // Identifica cada formulário
        const identificador = formulario.id || 
            formulario.getAttribute('action') || 
            window.location.pathname + '_form_' + indice;

        const chave = 'formulario_' + identificador;

        // Recupera os dados salvos
        const dadosSalvos = JSON.parse(localStorage.getItem(chave) || '{}');

        Object.keys(dadosSalvos).forEach(nome => {
            const campo = formulario.elements[nome];

            if (campo && campo.type !== 'password') {
                if (campo.type === 'checkbox' || campo.type === 'radio') {
                    campo.checked = dadosSalvos[nome];
                } else {
                    campo.value = dadosSalvos[nome];
                }
            }
        });

        formulario.addEventListener('input', salvar);
        formulario.addEventListener('change', salvar);

        function salvar() {
            const dados = {};

            Array.from(formulario.elements).forEach(campo => {
                if (campo.name && campo.type !== 'password') {
                    if (campo.type === 'checkbox' || campo.type === 'radio') {
                        dados[campo.name] = campo.checked;
                    } else {
                        dados[campo.name] = campo.value;
                    }
                }
            });

            localStorage.setItem(chave, JSON.stringify(dados));
        }

        // Limpa após envio
        formulario.addEventListener('submit', function () {
            localStorage.removeItem(chave);
        });

    });

});