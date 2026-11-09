<?php
session_start();
include '../infra/conexao.php';

$erro = '';

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
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['cargo'] = $usuario['cargo'];

            header("Location: pagina_monitoramento.php");
            exit;
        } else {
            $erro = "Senha incorreta! Tente novamente.";
        }
    } else {
        $erro = "E-mail não encontrado!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login InfoTrem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3"
             role="alert" style="z-index: 1055; width: 90%; max-width: 500px;">
            <strong>Ops!</strong>
            <?= htmlspecialchars($erro) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php endif; ?>

    <section id="pagina_login">

        <!-- Lado da Imagem (60%) -->
        <div id="lado_imagem">
            <div class="conteudo_imagem">
                <h1>InfoTrem</h1>
                <p>Tecnologia e monitoramento ferroviário.</p>
            </div>
        </div>

        <!-- Lado do Login (40%) -->
        <div id="lado_login">
            <div class="box_login">
                <h2>Bem-vindo ao InfoTrem!</h2>
                <p class="subtitulo">Preencha os dados abaixo para realizar login no site.</p>

                <form action="login.php" method="POST">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>

                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

                    <input type="submit" class="button_login" value="Entrar">
                </form>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
