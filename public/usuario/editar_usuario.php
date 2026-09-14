<?php

include '../../infra/conexao.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];


$sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
$stmt = $conexao->prepare($sql); 
$stmt->bind_param("ssi", $nome, $email, $id);

if ($stmt->execute() === TRUE) {
    echo "Usuário atualizado com sucesso!";
} else {
    echo "Erro ao atualizar usuário: " . $stmt->error;
}

} else { echo "ID do usuário não fornecido."; 
}