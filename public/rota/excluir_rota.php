<?php
if (!isset($_GET['id_trem'])) {
    echo "ID do trem não foi enviado.";
    exit;
}

$id = $_GET ['id'];
include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$sql = "DELETE FROM rotas WHERE id = ?";
$stmt = $conn-> prepare ($sql);
$stmt-> bind_param ("i", $id);

if ($stmt->execute ()) {
    echo " A rota foi excluído com sucesso! <br>";
    echo "<button type='button' onclick=\"window.location.href='listar_rotas.php'\">Voltar</button>";
}  else {
    echo "Erro ao excluir a rota: ". $conn->error;
}

?>