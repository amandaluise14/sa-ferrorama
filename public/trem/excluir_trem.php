<?php

if (!isset($_GET['id_trem'])) {
    echo "ID do trem não foi enviado.";
    exit;
}

$id_trem = $_GET ['id_trem'];

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$sql = "DELETE FROM trens WHERE id_trem = ?";
$stmt = $conn-> prepare ($sql);
if (!$stmt) {
    header("Location: listar_trem.php?erro=falha");
    exit;
}
$stmt-> bind_param ("i", $id_trem);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: listar_trem.php?sucesso=excluido");
    } else {
        header("Location: listar_trem.php?erro=nao_encontrado");
    }
} else {
    header("Location: listar_trem.php?erro=falha");
}

$stmt->close();
exit;
?>