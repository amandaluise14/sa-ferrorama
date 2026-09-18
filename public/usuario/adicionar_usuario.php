<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO cliente (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nome, $email, $senha);
    if ($stmt->execute() === TRUE) {
        echo "Novo cliente cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Adicionar Novo administrador/usuário</title>
</head>

<body>


<div style="display: flex;">



    <div class="pagina" >
        <div class="sidebar">

            <div class="logo">
                <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
            </div>

            <ul>
                <li>Início</li>
                <li class="active">Sensores e Trens</li>
                <li>Monitoramento</li>
                <li>Relatórios</li>
                <li>Adicionar usuário</li>
                <li>Sair</li>
            </ul>
        </div>

        
</div>


    <div class="formulario-container">
        <h2>Adicionar Novo administrador/usuário</h2>

    <form method="POST" class="forms_rotas">

    <div class="conteudo">


        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
          
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="telefone">Senha</label>
        <input type="text" id="telefone" name="telefone">
        <br><br>

        <label for="endereco">Confirmar senha</label>
        <input type="text" id="endereco" name="endereco">
        <br><br>

        <label for="endereco">Status</label>
        <input type="text" id="endereco" name="endereco">
        <br><br>

        <button type="submit">Cadastrar administrador/usuário</button>

                </div>

            </form>

        </div>

</div>
</body>

</html>

