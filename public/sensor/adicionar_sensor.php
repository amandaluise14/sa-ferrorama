<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';
$erro = '';
$sucesso = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $descricao_localizacao = $_POST['descricao_localizacao'];
    $dado_monitorado = $_POST['dado_monitorado'];

    $sql = "INSERT INTO sensores (nome, localizacao, descricao_localizacao, dado_monitorado) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $localizacao, $descricao_localizacao, $dado_monitorado);
    if ($stmt->execute() === TRUE) {
        $sucesso = "Novo sensor cadastrado com sucesso!";
    } else {
        $erro = "Erro ao cadastrar sensor: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">

</head>
<body>
    <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
          
<?php if ($_SESSION['cargo'] === 'administrador'): ?>

    <a href="../pagina_home.php" class="menu-link">
        <li>Início</li>
    </a>

    <a href="../pagina_relatorios.php" class="menu-link">
        <li>Relatórios</li>
    </a>

    <a href="../usuario/adicionar_usuario.php" class="menu-link">
        <li>Adicionar usuário</li>
    </a>

<?php endif; ?>

<!-- Aparece para administrador e usuário comum -->
<a href="../pagina_monitoramento.php" class="menu-link">
    <li>Monitoramento</li>
</a>

<a href="../logout.php" class="menu-link">
    <li>Sair</li>
</a>

    </ul>
    </div>

    <title>Cadastrar Sensor</title>
     <div class="formulario-container">
        <?php if (!empty($erro)): ?>
    <div class="alert alert-danger alert-dismissible fade show
                position-fixed top-0 start-50 translate-middle-x mt-3"
         role="alert"
         style="z-index: 1055; width: 90%; max-width: 500px;">

        <strong>⚠️ Ops!</strong>
        <?= htmlspecialchars($erro) ?>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar">
        </button>
    </div>
<?php endif; ?>

<?php if (!empty($sucesso)): ?>
    <div class="alert alert-success alert-dismissible fade show
                position-fixed top-0 start-50 translate-middle-x mt-3"
         role="alert"
         style="z-index: 1055; width: 90%; max-width: 500px;">

        <strong>✅ Sucesso!</strong>
        <?= htmlspecialchars($sucesso) ?>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar">
        </button>
    </div>
<?php endif; ?>
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Cadastrar Sensor</h2>
            <div class="conteudo">

        <label for="nome">Nome Sensor:</label>
        <input type="text" id="nome" name="nome" placeholder="Ex: Sensor de velocidade do trem 77" required>
        <br><br>
        <label for="localizacao">Localização do Sensor:</label>
        <br>
        <input type="radio" id="localizacao" name="localizacao" value="Trem"  required>
        <label for="localizacao">Trem</label>
        <br>
        <input type="radio" id="localizacao" name="localizacao" value="Rota" required>
        <label for="localizacao">Rota</label>
        <br><br>
        <label for="descricao_localizacao">Descrever Localização:</label>
        <input type="text" id="descricao_localizacao" name="descricao_localizacao" placeholder="Ex: Velocidade do sensor localizado na rota" required>
        <br><br>
        <label for="dado_monitorado">Tipo do Dado Monitorado:</label>
        <input type="text" id="dado_monitorado" name="dado_monitorado" placeholder="Ex: Velocidade" required>
        <br><br>
        <button id="botaoCadastro" type="submit">Cadastrar Sensor</button>
        <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
        <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_sensor.php';">Visualizar Sensores Cadastrados</button>
    </div>
    </form> 
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



