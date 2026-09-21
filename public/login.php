<?php

include '../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta para verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuário autenticado com sucesso
        echo "Login bem-sucedido!";
        // Aqui você pode redirecionar para a página principal ou iniciar uma sessão
    } else {
        // Usuário não encontrado ou senha incorreta
        echo "E-mail ou senha incorretos.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login InfoTrem</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
    <label>E-mail:</label>
    <input type="email" name="email" required>
    <br><br>
    <label>Senha:</label>
    <input type="password" name="senha" required>
    <br><br>
    <button type="submit">Entrar</button>
    </form>
</body>
</html>
