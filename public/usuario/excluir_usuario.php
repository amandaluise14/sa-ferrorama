<?php

$id_usuario = $_GET['id_usuario'];

include '../../infra/conexao.php';

$sql = "DELETE FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    echo "O usuário foi excluído com sucesso!<br>";
    echo "<button type='button' onclick=\"window.location.href='../../index.php'\">Voltar</button>";
} else {
    echo "Erro ao excluir o usuário: " . $conn->error;
}

?>