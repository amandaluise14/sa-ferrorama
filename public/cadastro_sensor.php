
<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $descrever = $_POST['descrever'];
    $tipo_dado  = $_POST['tipo_dado'];

    $sql = "INSERT INTO clientes (nome, localizacao, descrever, endereco) VALUES ('$nome', '$localizacao', '$descrever', '$tipo_dado')";
    if ($conn->query($sql) === TRUE) {
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
    <title>Adicionar Novo Sensor</title>
</head>
<body>
    <h2>Adicionar Novo Sensor</h2>
    <form method="POST">
        <label for="nome">Nome Sensor </label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="localizacao">Localização do Sensor </label>
        <input type="localizacao" id="localizacao" name="localizacao" required>
        <br><br>
        <label for="descrever">Descrever Localização</label>
        <input type="text" id="descrever" name="descrever">
        <br><br>
        <label for="tipo_dado">Tipo de Dado Monitorado </label>
        <input type="text" id="tipo_dado" name="endereco">
        <br><br>
        <button type="submit">Cadastrar Sensor</button>
    </form> 
    <br>  
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>