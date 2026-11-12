
<?php

if (!isset($_GET['id_sensor'])) {
    echo "ID do sensor não foi enviado.";
    exit;
}

$id_sensor = $_GET['id_sensor'];

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

// // Verifica se o sensor possui leituras cadastradas
// $sql_verifica = "SELECT COUNT(*) AS total FROM leituras WHERE sensor_id = ?";
// $stmt = $conn->prepare($sql_verifica);

// if (!$stmt) {
//     header("Location: listar_sensor.php?erro=falha");
//     exit;
// }

// $stmt->bind_param("i", $id_sensor);
// $stmt->execute();

// $resultado = $stmt->get_result();
// $dados = $resultado->fetch_assoc();

// $stmt->close();

// // Impede a exclusão se possuir leituras
// if ($dados['total'] > 0) {
//     header("Location: listar_sensor.php?erro=possui_leituras");
//     exit;
// }

$sql = "SELECT rota_id FROM sensores WHERE id_sensor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_sensor);
$stmt->execute();

$resultado = $stmt->get_result();
$sensor = $resultado->fetch_assoc();

if ($sensor && $sensor['rota_id'] != NULL) {
    header("Location: listar_sensor.php?erro=em_rota");
    exit;
}

// Exclui o sensor
$sql = "DELETE FROM sensores WHERE id_sensor = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: listar_sensor.php?erro=falha");
    exit;
}

$stmt->bind_param("i", $id_sensor);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: listar_sensor.php?sucesso=excluido");
        exit;
    } else {
        header("Location: listar_sensor.php?erro=nao_encontrado");
        exit;
    }
} else {
    header("Location: listar_sensor.php?erro=falha");
    exit;
}

$stmt->close();
exit;
?>
