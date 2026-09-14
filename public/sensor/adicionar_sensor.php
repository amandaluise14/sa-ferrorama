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
</head>
<body>
    <title>Cadastrar Sensor</title>
    <form method="POST">
        <label for="nome">Nome Sensor:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="localizacao">Localizacao do Sensor:</label>
        <input type="text" id="localizacao" name="localizacao" required>
        <br><br>
        <label for="descricao_localizacao">Descrever Localizacao:</label>
        <input type="text" id="descricao_localizacao" name="descricao_localizacao" required>
        <br><br>
        <label for="dado_monitorado">Tipo do Dado Monitorado:</label>
        <input type="text" id="dado_monitorado" name="dado_monitorado" required>
        <br><br>
        <button type="submit">Cadastrar Sensor</button>
    </form> 
    <br>
    <button type="button" onclick="window.location.href='../../home.php';">Cancelar</button>
</body>
</html>



