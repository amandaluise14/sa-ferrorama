<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'];
    $velocidade = $_POST['velocidade'];
    $linha = $_POST['linha'];
    $carga = $_POST['carga'];

    $sql = "INSERT INTO trem (modelo, velocidade, linha, carga) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $modelo, $velocidade, $linha, $carga);
    if ($stmt->execute() === TRUE) {
        echo "Novo trem cadastrado com sucesso!";
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
    <title>Cadastrar Trem</title>
</head>
<body>
    <h2>Cadastrar Novo Trem</h2>
    <form method="POST">
        
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required>
        <br><br>
        <label for="velocidade">Velocidade:</label>
        <input type="text" id="velocidade" name="velocidade" required>
        <br><br>
        <label for="linha">Linha:</label>
        <input type="number" id="linha" name="linha" required>
        <br><br>
        <label for="carga">Carga:</label>
        <input type="text" id="carga" name="carga" required>
        <br><br>
        <button type="submit">Cadastrar Trem</button>
    </form> 
    <br>  
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>
