<?php

$id_trem = $_GET ['id_trem'];
include '../../infra/conexao.php';

$sql = "DELETE FROM trens WHERE id_trem = ?";
$stmt = $conn-> prepare ($sql);
$stmt-> bind_param ("i", $id_trem);

if ($stmt->execute ()) {
    echo "O trem foi excluído com sucesso! <br>";
    echo "<button type='button' onclick=\"window.location.href='../../index.php'\">Voltar</button>";
}  else {
    echo "Erro ao excluir trem: ". $conn->error;
}

?>