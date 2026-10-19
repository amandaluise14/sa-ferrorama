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
$stmt-> bind_param ("i", $id_trem);

if ($stmt->execute ()) {
    header("Location: listar_trem.php");
    exit;
}  else {
    echo "Erro ao excluir trem: ". $conn->error;
}

?>