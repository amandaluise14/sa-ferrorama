<?php
if (!isset($_GET['id_rota'])) {
    echo "ID da rota não foi enviado.";
    exit;
}

$id = $_GET['id_rota'];

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

// Verifica se a rota possui um trem vinculado
$sql_verifica = "SELECT COUNT(*) AS total FROM rotas WHERE id_rota = ? AND trem_id IS NOT NULL";
$stmt = $conn->prepare($sql_verifica);

if (!$stmt) {
    header("Location: listar_rotas.php?erro=falha");
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();
$dados = $resultado->fetch_assoc();

$stmt->close();

// Impede a exclusão se houver um trem vinculado
if ($dados['total'] > 0) {
    header("Location: listar_rotas.php?erro=possui_trem");
    exit;
}

// Exclui a rota
$sql = "DELETE FROM rotas WHERE id_rota = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: listar_rotas.php?erro=falha");
    exit;
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: listar_rotas.php?sucesso=excluido");
        exit;
    } else {
        header("Location: listar_rotas.php?erro=nao_encontrado");
        exit;
    }
} else {
    header("Location: listar_rotas.php?erro=falha");
    exit;
}

$stmt->close();
exit;
?>