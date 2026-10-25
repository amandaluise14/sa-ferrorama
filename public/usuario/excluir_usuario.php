<?php

if (!isset($_GET['id'])) {
    echo "ID do usuário não foi enviado.";
    exit;
}

$id_usuario = $_GET['id'];

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$sql = "DELETE FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    header("Location: visualizar_usuario.php?erro=falha");
    exit;
}
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: visualizar_usuario.php?sucesso=excluido");
    } else {
        header("Location: visualizar_usuario.php?erro=nao_encontrado");
    }
} else {
    header("Location: visualizar_usuario.php?erro=falha");
}

$stmt->close();
exit;
?>