<?php
if (!isset($_GET['id_rota'])) {
    echo "ID da rota não foi enviado.";
    exit;
}

$id = $_GET ['id_rota'];
include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$sql = "DELETE FROM rotas WHERE id_rota = ?";
$stmt = $conn-> prepare ($sql);
$stmt-> bind_param ("i", $id_rota);

if ($stmt->execute ()) {
    header("Location: listar_rota.php");
    exit;
}  else {
    echo "Erro ao excluir a rota: ". $conn->error;
}

?>