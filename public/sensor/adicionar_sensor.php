<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $descricao_localizacao = $_POST['descricao_localizacao'];
    $dado_monitorado = $_POST['dado_monitorado'];

    $sql = "INSERT INTO sensores (nome, localizacao, descricao_localizacao, dado_monitorado) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $localizacao, $descricao_localizacao, $dado_monitorado);
    if ($stmt->execute() === TRUE) {
        echo "Novo sensor cadastrado com sucesso!";
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
    <title>Cadastrar Sensor</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
        <li>Início</li>
        <li class="active"> Sensores e Trens</li>
        <li>Monitoramento</li>
        <li>Relatórios</li>
        <li>Adicionar usuário</li>
        <li>Sair</li>
    </ul>
    </div>

    <title>Cadastrar Rota</title>
     <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <div class="conteudo">

    <h2 id="titulo-admin">Cadastrar Sensor</h2>

    <form method="POST">
        <label for="nome">Nome Sensor:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="localizacao">Localização do Sensor:</label>
        <br>
        <input type="radio" id="localizacao" name="localizacao" value="Trem" required>
        <label for="localizacao">Trem</label>
        <br>
        <input type="radio" id="localizacao" name="localizacao" value="Rota" required>
        <label for="localizacao">Rota</label>
        <br><br>
        <label for="descricao_localizacao">Descrever Localização:</label>
        <input type="text" id="descricao_localizacao" name="descricao_localizacao" required>
        <br><br>
        <label for="dado_monitorado">Tipo do Dado Monitorado:</label>
        <input type="text" id="dado_monitorado" name="dado_monitorado" required>
        <br><br>
        <button id="botaoCadastro" type="submit">Cadastrar Sensor</button>
        <button type="button" onclick="window.location.href='../../home.php';">Cancelar</button>
    </form> 
    
</body>
</html>



