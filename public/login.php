<?php
session_start();
include '../infra/conexao.php';

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

<<<<<<< HEAD
=======
<<<<<<< HEAD
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    echo "senhaHash". $senhaHash;
=======

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

>>>>>>> c7ebc39ecca432f09e6695d794f4180aa42ad80e
>>>>>>> 8feb9ade1509999c9d51b54940cd4c868fdf902c

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
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['cargo'] = $usuario['cargo'];

            header("Location: pagina_monitoramento.php");
            exit;
            } else {
<<<<<<< HEAD
            echo "Senha INCORRETA!<br>";
               

=======
<<<<<<< HEAD
            echo "Senha INCORRETA!<br>";
               
            echo "senhaHash: " . $senhaHash;
            
>>>>>>> 8feb9ade1509999c9d51b54940cd4c868fdf902c
        }
    } else {
<<<<<<< HEAD
        echo "E-mail não encontrado!<br>";
    }
=======
=======
            $erro = "Senha incorreta!";                
            }
    } else { 
>>>>>>> c7ebc39ecca432f09e6695d794f4180aa42ad80e
        $erro = "E-mail não encontrado!";
}
$stmt->close();
>>>>>>> 8feb9ade1509999c9d51b54940cd4c868fdf902c
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
    <?php if (!empty($erro)) { ?>
        <div class="mensagem-erro">
            <span class="icone-alerta">!</span>
            <div class="texto-alerta">
                <strong>Ops! Não foi possível entrar.</strong>
                <p><?php echo htmlspecialchars($erro); ?></p>
            </div>
        </div>
    <?php } ?>
      <div id="container">
    <h2>Login</h2>

    <p class="subtitulo">Preencha os dados abaixo para realizar login no site.</p>
    <form action="login.php" method="POST">

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br><br>
        <input type="submit" value="Entrar">

    </form>


</body>

</html>