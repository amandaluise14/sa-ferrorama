<?php

if (!isset($_GET['id'])) {
    echo "ID do usuário não foi enviado.";
    exit;
}

$id_usuario = $_GET['id'];

include '../../infra/conexao.php';

$sql = "DELETE FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    echo "O usuário foi excluído com sucesso!<br>";
    echo "<button type='button' onclick=\"window.location.href='visualizar_usuario.php'\">Voltar</button>";
} else {
    echo "Erro ao excluir o usuário: " . $conn->error;
}

?>