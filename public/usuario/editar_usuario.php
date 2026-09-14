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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>

    <h2>Editar Usuário</h2>

    <form action="editar.php" method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>

        <br><br>

        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <button type="submit">Salvar alterações</button>

    </form>

</body>
</html>
