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
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['cargo'] = $usuario['cargo'];
            header("Location: pagina_home.php");
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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login InfoTrem</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body id="pagina_login">

    <div id="container_login">

        <h2 id="titulo_login">Login</h2>

        <p id="subtitulo_login">
            Preencha os dados abaixo para realizar login no site.
        </p>

        <?php if (isset($erro)) { ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php } ?>

        <form id="form_login" method="POST">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>

        </form>

    </div>

</body>

</html>