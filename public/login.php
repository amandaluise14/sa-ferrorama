
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

        <div id="container">
            <h2>Login</h2>

            <p class="subtitulo">
                Preencha os dados abaixo para realizar login no site.
            </p>

            <form action="login.php" method="POST">

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>

                <input type="submit" class="button_login" value="Entrar">

            </form>
        </div>

    </section>

    <section class="landing-page">

        <div class="landing-conteudo">

            <p class="landing-etiqueta">BEM-VINDO AO INFOTREM</p>

            <h1>Uma nova forma de acompanhar o transporte ferroviário</h1>

            <p class="landing-descricao">
                O InfoTrem é um sistema de gerenciamento ferroviário desenvolvido
                para facilitar o acompanhamento de trens, linhas, rotas e sensores
                em um só lugar.
            </p>


        </div>

        <div class="landing-sobre" id="sobre-projeto">

            <h2>Sobre o projeto</h2>

            <p>
                O projeto foi desenvolvido para auxiliar no gerenciamento e no
                monitoramento do transporte ferroviário, reunindo informações
                importantes para facilitar a visualização e o acompanhamento
                das operações.
            </p>

            <div class="landing-cards">

                <div class="landing-card">
                    <h3>Trens</h3>
                    <p>
                        Consulte informações sobre os trens cadastrados,
                        seus modelos, velocidades e linhas.
                    </p>
                </div>

                <div class="landing-card">
                    <h3>Rotas</h3>
                    <p>
                        Visualize as rotas ferroviárias, as estações de origem
                        e destino e os trens vinculados.
                    </p>
                </div>

                <div class="landing-card">
                    <h3>Sensores</h3>
                    <p>
                        Acompanhe informações dos sensores relacionados à
                        localização, velocidade e possíveis anormalidades.
                    </p>
                </div>

                <div class="landing-card">
                    <h3>Monitoramento</h3>
                    <p>
                        Reúna informações sobre o funcionamento dos trens
                        para facilitar o acompanhamento das operações.
                    </p>
                </div>

            </div>

            <div class="landing-final">
                <h2>Conheça o InfoTrem</h2>

                <p>
                    Entre no sistema para acessar as funcionalidades disponíveis
                    de acordo com o seu tipo de usuário.
                </p>

                <a href="#pagina_login" class="landing-botao">
                    Voltar ao login
                </a>
            </div>

        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
