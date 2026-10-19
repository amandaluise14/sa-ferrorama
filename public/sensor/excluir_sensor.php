<?php
if (!isset($_GET['id_sensor'])) {
    echo "ID do sensor não foi enviado.";
    exit;
}

$id_sensor = $_GET ['id_sensor'];

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$sql = "DELETE FROM sensores WHERE id_sensor = ?";
$stmt = $conn-> prepare ($sql);
$stmt-> bind_param ("i", $id_sensor);

if ($stmt->execute ()) {
    header("Location: listar_sensor.php");
    exit;
}  else {
    echo "Erro ao excluir o sensor: ". $conn->error;
}

?>