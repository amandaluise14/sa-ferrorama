<?php
session_start();
include '../infra/conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        die("Erro no execute: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            echo "Senha correta!<br>";
            header("Location: pagina_monitoramento.php");
            exit;
        } else {
            echo "Senha INCORRETA!<br>";
        }
    } else {
        echo "E-mail não encontrado!<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login InfoTrem</title>
     <link rel="stylesheet" href="../style/style.css">
</head>

<body id="pagina_login">
      <div id="container">
    <h2>Login</h2>

    <p class="subtitulo">Preencha os dados abaixo para realizar login no site.</p>
    
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