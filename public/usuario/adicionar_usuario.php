<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO cliente (nome, email, senha) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "Novo cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Administrador/Usuário</title>

    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>

<div class="pagina">

    <div class="sidebar">

        <div class="logo">
            <img id="imagem_logo"
                 src="../../assets/image/logo_png_branca.png"
                 alt="Logo Info Trem">
        </div>

        <ul>
            <li>Início</li>
            <li>Sensores e Trens</li>
            <li>Monitoramento</li>
            <li>Relatórios</li>
            <li class="active">Adicionar usuário</li>
            <li>Sair</li>
        </ul>

    </div>

    <div class="formulario-container">

        <div class="form-container">

            <h2 id="titulo-admin">
                Adicionar Administrador/Usuário
            </h2>

            <p>
                Preencha as informações abaixo para cadastrar um novo usuário ou administrador.
            </p>

            <form method="POST" class="forms_rotas">

                <div class="form-row">

                    <div class="form-group">
                        <label for="nome">Nome completo</label>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="confirmar_senha">Confirmar senha</label>
                        <input
                            type="password"
                            id="confirmar_senha"
                            name="confirmar_senha"
                            required>
                    </div>

                </div>

                <div class="form-group">

                    <label for="status">Status</label>

                    <select id="status" name="status">
                        <option value="">Selecione</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>

                </div>

                <div class="botoes">

                    <button type="button">
                        Cancelar
                    </button>

                    <button type="submit">
                        Salvar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>