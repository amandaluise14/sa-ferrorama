
document.addEventListener('DOMContentLoaded', function () {

    // Localiza os formulários de usuários
    const formularios = document.querySelectorAll('form');

    formularios.forEach(function (formulario) {

        // Verifica se é um formulário de usuário
        if (!formulario.querySelector('[name="nome"]') ||
            !formulario.querySelector('[name="cpf"]')) {
            return;
        }

        formulario.addEventListener('submit', function (event) {

            const nome = formulario.querySelector('[name="nome"]');
            const cpf = formulario.querySelector('[name="cpf"]');
            const email = formulario.querySelector('[name="email"]');
            const telefone = formulario.querySelector('[name="telefone"]');
            const senha = formulario.querySelector('[name="senha"]');
            const data = formulario.querySelector('[name="data_nascimento"]');
            const cep = formulario.querySelector('[name="cep"]');
            const endereco = formulario.querySelector('[name="endereco"]');
            const bairro = formulario.querySelector('[name="bairro"]');
            const cidade = formulario.querySelector('[name="cidade"]');
            const uf = formulario.querySelector('[name="uf"]');

            let erros = [];

            // 1. VALIDAÇÃO DO NOME
            if (nome) {
                const valorNome = nome.value.trim();

                const nomeValido = /^[\p{L}]+(?:[ '-][\p{L}]+)*$/u.test(valorNome);

                if (!nomeValido) {
                    erros.push('Digite um nome válido, utilizando apenas letras.');
                } else if (valorNome.split(/\s+/).length < 2) {
                    erros.push('Digite o nome completo (nome e sobrenome).');
                }
            }

            // 2. VALIDAÇÃO DO CPF
            if (cpf) {
                const valorCPF = cpf.value.replace(/\D/g, '');

                if (!validarCPF(valorCPF)) {
                    erros.push('Digite um CPF válido.');
                }
            }

            // 3. VALIDAÇÃO DO E-MAIL
            if (email) {
                const valorEmail = email.value.trim();

                const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valorEmail);

                if (!emailValido) {
                    erros.push('Digite um e-mail válido.');
                }
            }

            // 4. VALIDAÇÃO DO TELEFONE
            if (telefone) {
                const valorTelefone = telefone.value.replace(/\D/g, '');

                if (!/^[1-9]{2}9?[0-9]{8}$/.test(valorTelefone)) {
                    erros.push('Digite um telefone válido com DDD.');
                }
            }

            // 5. VALIDAÇÃO DA SENHA
            if (senha && senha.value !== '' && senha.value.length < 5) {
                erros.push('A senha deve possuir pelo menos 5 caracteres.');
            }

            // 6. VALIDAÇÃO DA DATA DE NASCIMENTO
            if (data && data.value) {
                const hoje = new Date();
                hoje.setHours(0, 0, 0, 0);

                const dataInformada = new Date(data.value + 'T00:00:00');

                if (isNaN(dataInformada.getTime()) || dataInformada > hoje) {
                    erros.push('A data de nascimento não pode ser futura.');
                }
            }

            // 7. VALIDAÇÃO DO CEP
            if (cep) {
                const valorCEP = cep.value.replace(/\D/g, '');

                if (!/^\d{8}$/.test(valorCEP)) {
                    erros.push('O CEP deve possuir 8 números.');
                }
            }

            // 8. VALIDAÇÃO DO ENDEREÇO
            if (endereco && endereco.value.trim().length < 3) {
                erros.push('Digite um endereço válido.');
            }

            // 9. VALIDAÇÃO DO BAIRRO
            if (bairro && !/^[\p{L}\d\s.'-]{2,}$/u.test(bairro.value.trim())) {
                erros.push('Digite um bairro válido.');
            }

            // 10. VALIDAÇÃO DA CIDADE
            if (cidade && !/^[\p{L}\s.'-]{2,}$/u.test(cidade.value.trim())) {
                erros.push('Digite uma cidade válida.');
            }

            // 11. VALIDAÇÃO DO ESTADO
            if (uf && !/^[A-Za-z]{2}$/.test(uf.value.trim())) {
                erros.push('Digite uma UF com duas letras.');
            }

            // Impede o envio se houver erros
            if (erros.length > 0) {
                event.preventDefault();

                alert(
                    'Verifique os seguintes campos:\n\n' +
                    erros.map(erro => '• ' + erro).join('\n')
                );
            }

        });

    });

    // FUNÇÃO PARA VALIDAR CPF
    function validarCPF(cpf) {

        if (!/^\d{11}$/.test(cpf)) {
            return false;
        }

        if (/^(\d)\1{10}$/.test(cpf)) {
            return false;
        }

        let soma = 0;

        for (let i = 0; i < 9; i++) {
            soma += Number(cpf[i]) * (10 - i);
        }

        let primeiroDigito = (soma * 10) % 11;

        if (primeiroDigito === 10) {
            primeiroDigito = 0;
        }

        if (primeiroDigito !== Number(cpf[9])) {
            return false;
        }

        soma = 0;

        for (let i = 0; i < 10; i++) {
            soma += Number(cpf[i]) * (11 - i);
        }

        let segundoDigito = (soma * 10) % 11;

        if (segundoDigito === 10) {
            segundoDigito = 0;
        }

        return segundoDigito === Number(cpf[10]);
    }

});
