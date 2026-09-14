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
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $sensor['nome']; ?>" required>
        <br><br>
        <label for="localizacao">Localizacao:</label>
        <input type="text" id="localizacao" name="localizacao" value="<?php echo $sensor['localizacao']; ?>" required>
        <br><br>
        <label for="descricao_localizacao">Descricao da localizacao:</label>
        <input type="text" id="descricao_localizacao" name="descricao_localizacao" value="<?php echo $sensor['descricao_localizacao']; ?>">
        <br><br>
        <label for="dado_monitorado">Tipo do dado monitorado:</label>
        <input type="text" id="dado_monitorado" name="dado_monitorado" value="<?php echo $sensor['dado_monitorado']; ?>">
        <br><br>
        <button type="submit">Cadastrar Sensor</button>
    </form> 
</body>
</html>



