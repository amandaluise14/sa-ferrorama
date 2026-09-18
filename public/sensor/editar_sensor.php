<?php

include '../../infra/conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_sensor = $_POST['id_sensor'];
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $descricao_localizacao = $_POST['descricao_localizacao'];
    $dado_monitorado = $_POST['dado_monitorado'];

    $sql = "UPDATE sensores SET nome=?, localizacao=?, descricao_localizacao=?, dado_monitorado=? WHERE id_sensor=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $localizacao, $descricao_localizacao, $dado_monitorado, $id_sensor);
    if ($stmt->execute() === TRUE) {
        echo "Sensor atualizado com sucesso!";
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
    <title>Editar Sensor</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <div class="d-flex align-items-start">
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

    <h2>Editar Sensor</h2>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome"required>
        <br><br>
        <label for="localizacao">Localizacao:</label>
        <input type="text" id="localizacao" name="localizacao" required>
        <br><br>
        <label for="descricao_localizacao">Descricao da localizacao:</label>
        <input type="text" id="descricao_localizacao" name="descricao_localizacao" >
        <br><br>
        <label for="dado_monitorado">Tipo do dado monitorado:</label>
        <input type="text" id="dado_monitorado" name="dado_monitorado" >
        <br><br>
        <button type="submit">Editar Sensor</button>
    </form> 
</body>
</html>