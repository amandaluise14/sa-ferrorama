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
if (!$stmt) {
    header("Location: listar_rotas.php?erro=falha");
    exit;
}
$stmt-> bind_param ("i", $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: listar_rotas.php?sucesso=excluido");
    } else {
        header("Location: listar_rotas.php?erro=nao_encontrado");
    }
} else {
    header("Location: listar_rotas.php?erro=falha");
}

$stmt->close();
exit;
?>