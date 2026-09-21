<?php

include '../../infra/conexao.php';

if (!isset($_GET['id_trem']) || empty($_GET['id_trem'])) {
    die("ID do trem não foi informado.");
}

$id_trem = (int) $_GET['id_trem'];

$sql = "SELECT * FROM trens WHERE id_trem = $id_trem";

$trem_editantes = $conn->query($sql);

if (!$trem_editantes) {
    die("Erro na consulta: " . $conn->error);
}

if ($trem_editantes->num_rows == 0) {
    die("Trem não encontrado.");
}

$trem = $trem_editantes->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'];
    $velocidade = $_POST['velocidade'];
    $linha = $_POST['linha'];
    $carga = $_POST['carga'];

    $sql = "UPDATE trens SET modelo='$modelo', velocidade='$velocidade', linha='$linha', carga='$carga' WHERE id_trem=$id_trem";
    if ($conn->query($sql) === TRUE) {
        echo "Trem atualizado com sucesso!";
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
    <title>Editar Trem</title>
</head>
<body>
    <h2>Editar Trem</h2>
    <form method="POST">
        <form method="POST">
        <label for="modelo">Modelo trem:</label>
        <input type="text" id="modelo" name="modelo" value="<?php echo $trem['modelo']; ?>" required>
        <br><br>
        <label for="velocidade">Velocidade limite:</label>
        <input type="text" id="velocidade" name="velocidade" value="<?php echo $trem['velocidade']; ?>" required>
        <br><br>
        <label for="linha">Linha:</label>
        <input type="number" id="linha" name="linha" value="<?php echo $trem['linha']; ?>" required>
        <br><br>
        <label for="carga">Carga:</label>
        <input type="text" id="carga" name="carga" value="<?php echo $trem['carga']; ?>" required>
        <br><br>
        <button type="submit">Editar Trem</button>
    </form> 
    </form> 
</body>
</html>