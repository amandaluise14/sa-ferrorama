<?php
session_start();
include '../infra/conexao.php';

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    echo "senhaHash". $senhaHash;
<<<<<<< HEAD
=======
    
>>>>>>> 7742b69a780279f42c3b198ef1b6c808d0f44e1d

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

           $erro = "Senha incorreta! Tente novamente.";
           echo "senhaHash: " . $senhaHash;
        
        }
    } else {
        
        $erro = "E-mail não encontrado!";
          echo "senhaHash". $senhaHash;
}
$stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login InfoTrem</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../style/style.css">
</head>
<body id="pagina_login">
    <?php if (!empty($erro)): ?>
    <div class="alert alert-danger alert-dismissible fade show 
                position-fixed top-0 start-50 translate-middle-x mt-3"
         role="alert"
         style="z-index: 1055; width: 90%; max-width: 500px;">

        <strong>Ops!</strong>
        <?= htmlspecialchars($erro) ?>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar">
        </button>
    </div>
<?php endif; ?>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>