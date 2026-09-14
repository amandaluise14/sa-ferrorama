<?php

include '../../infra/conexao.php';

$id_rota = $_GET['id_rota'];
$sql = "SELECT * FROM rotas WHERE id_rota = $id_rota";
$rota_editantes = $conn->query($sql);
$rota = $rota_editantes->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $sensor_id = $_POST['sensor_id'];

    $sql = "UPDATE rotas SET nome='$nome', estacao_origem='$estacao_origem', estacao_destino='$estacao_destino' distancia_total='$distancia_total' sensor_id='$sensor_id' WHERE id_sensor=$id_sensor";
    if ($conn->query($sql) === TRUE) {
        echo "Rota atualizado com sucesso!";
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
    <title>Editar Rota</title>
</head>
<body>
    <h2>Editar Rota</h2>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $rota['nome']; ?>" required>
        <br><br>
        <label for="estacao_origem">Estação Origem:</label>
        <input type="text" id="estacao_origem" name="estacao_origem" value="<?php echo $rota['estacao_origem']; ?>" required>
        <br><br>
        <label for="estacao_destino">Estação Destino:</label>
        <input type="text" id="estacao_destino" name="estacao_destino" value="<?php echo $rota['estacao_destino']; ?>">
        <br><br>
        <label for="distancia_total">Distância Total:</label>
        <input type="text" id="distancia_total" name="distancia_total" value="<?php echo $rota['distancia_total']; ?>">
        <br><br>
        <select name="sensor_id" required>
            <option value="" >Selecione o Sensor</option>
            <?php
                $sql = "SELECT id, nome FROM sensores";
                $sensores = $conn->query($sql);
                while ($sensor = $sensores->fetch_assoc()) {
            ?>

            <option value="<?php echo $sensor['id'];?>" <?php if ($rota['sensor_id'] == $sensor['id']) echo 'selected'; ?>>
                <?php echo $sensor['nome'];?>
            </option>


            <?php
                } 
            ?>
        </select>
        <button type="submit">Editar Rota</button>
    </form> 
</body>
</html>