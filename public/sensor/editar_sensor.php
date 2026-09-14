<?php

include '../../infra/conexao.php';

$id_sensor = $_GET['id_sensor'];
$sql = "SELECT * FROM sensores WHERE id_sensor = $id_sensor";
$sensor_editantes = $conn->query($sql);
$sensor = $sensor_editantes->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $descricao_localizacao = $_POST['descricao_localizacao'];
    $dado_monitorado = $_POST['dado_monitorado'];

    $sql = "UPDATE sensores SET nome='$nome', localizacao='$localizacao', descricao_localizacao='$descricao_localizacao' dado_monitorado='$dado_monitorado' WHERE id_sensor=$id_sensor";
    if ($conn->query($sql) === TRUE) {
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
</head>
<body>
    <h2>Editar Sensor</h2>
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
        <button type="submit">Editar Sensor</button>
    </form> 
</body>
</html>