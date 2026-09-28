<?php

include '../../infra/conexao.php';

$id = $_GET['id'] ?? '';
$sql = "DELETE FROM sensores WHERE id_sensor = ?";
$stmt = $conn-> prepare ($sql);
$stmt-> bind_param ("i", $id);

if ($stmt->execute ()) {
    echo "O sensor foi excluído com sucesso! <br>";
    echo "<button type='button' onclick=\"window.location.href='listar_sensor.php'\">Voltar</button>";
}  else {
    echo "Erro ao excluir o sensor: ". $conn->error;
}

$stmt->close();
$conn->close();

?>