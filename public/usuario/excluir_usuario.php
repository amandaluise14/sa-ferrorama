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

        // Verifica se o usuário excluiu a própria conta
        if ($_SESSION['id_usuario'] == $id_usuario) {
            session_unset();
            session_destroy();

            header("Location: ../login.php");
            exit;
        }

        header("Location: visualizar_usuario.php?sucesso=excluido");
        exit;

    } else {
        header("Location: visualizar_usuario.php?erro=nao_encontrado");
        exit;
    }
} else {
    header("Location: visualizar_usuario.php?erro=falha");
    exit;
}

$stmt->close();
exit;
?>