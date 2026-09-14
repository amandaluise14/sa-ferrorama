<?php

$id = $_GET ['id'];
include '../../infra/conexao.php';

$sql = "DELETE FROM sensores WHERE id = ?";
$stmt = $conexao-> prepare ($sql);
$stmt-> bind_param ("i", $id);

if ($stmt->execute ()) {
    echo "O sensor foi excluído com sucesso! <br>";
    echo "<button type='button' onclick=\"window.location.href='../../index.php'\">Voltar</button>";
}  else {
    echo "Erro ao excluir o sensor: ". $conexao->error;
}

?>