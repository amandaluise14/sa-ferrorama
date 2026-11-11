<?php

if (!isset($_GET['id_trem'])) {
    echo "ID do trem não foi enviado.";
    exit;
}

$id_trem = $_GET['id_trem'];

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$sql_verifica = "SELECT COUNT(*) AS total FROM trens WHERE id_trem = ? AND usuario_id IS NOT NULL";
$stmt = $conn->prepare($sql_verifica);

if (!$stmt) {
    header("Location: listar_trem.php?erro=falha");
    exit;
}

$stmt->bind_param("i", $id_trem);
$stmt->execute();

$resultado = $stmt->get_result();
$dados = $resultado->fetch_assoc();

$stmt->close();

if ($dados['total'] > 0) {
    header("Location: listar_trem.php?erro=possui_usuarios");
    exit;
}

$sql = "DELETE FROM trens WHERE id_trem = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: listar_trem.php?erro=falha");
    exit;
}

$stmt->bind_param("i", $id_trem);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: listar_trem.php?sucesso=excluido");
        exit;
    } else {
        header("Location: listar_trem.php?erro=nao_encontrado");
        exit;
    }
} else {
    header("Location: listar_trem.php?erro=falha");
    exit;
}

$stmt->close();
exit;
?>