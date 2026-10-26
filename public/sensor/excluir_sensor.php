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
if (!$stmt) {
    header("Location: listar_sensor.php?erro=falha");
    exit;
}
$stmt-> bind_param ("i", $id_sensor);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: listar_sensor.php?sucesso=excluido");
    } else {
        header("Location: listar_sensor.php?erro=nao_encontrado");
    }
} else {
    header("Location: listar_sensor.php?erro=falha");
}

$stmt->close();
exit;
?>