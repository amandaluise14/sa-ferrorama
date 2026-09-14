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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar administrador/usuário</title>
</head>
<body>
    <h2>Editar administrador/usuário</h2>
    <form method="POST">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="telefone">Senha</label>
        <input type="text" id="telefone" name="telefone">
        <br><br>
        <label for="endereco">Confirmar senha</label>
        <input type="text" id="endereco" name="endereco">
        <br><br>
        <label for="endereco">Status</label>
        <input type="text" id="endereco" name="endereco">
        <br><br>
        <button type="submit">Editar administrador/usuário</button>
    </form> 
    <br>  
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>

