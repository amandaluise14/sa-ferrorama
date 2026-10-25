<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modelo = $_POST['modelo'];
    $velocidade = $_POST['velocidade'];
    $linha = $_POST['linha'];
    $carga = $_POST['carga'];
    $usuario_id = $_POST['usuario_id'];

    $sql = "INSERT INTO trens (modelo, velocidade, linha, carga, usuario_id)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sissi",
        $modelo,
        $velocidade,
        $linha,
        $carga,
        $usuario_id
    );

    if ($stmt->execute()) {
        $sucesso = "Novo trem cadastrado com sucesso!";
    } else {
        $erro = "Erro ao cadastrar trem: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Trem </title>
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

    <a href="adicionar_usuario.php" class="menu-link">
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

    <title>Cadastar Trem  </title>
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
            <h2 id="titulo-admin">Cadastrar Trem</h2>
            <div class="conteudo">

    <label for="modelo">Modelo Trem:</label>
    <input type="text" id="modelo" name="modelo" placeholder="Ex: Modelo A" required>
     <br><br>
    <label for= "velocidade">Velocidade Limite (km/h):</label>
    <input type="number" id="velocidade" name="velocidade" placeholder="Ex: 120 km/h" required>
     <br><br>
     <label for= "linha">Linha:</label>
    <input type="text" id="linha" name="linha" placeholder="Ex: Linha 1" required>
     <br><br>
    <label for="carga">Carga:</label>
     <input type="text" id="carga" name="carga" placeholder="Ex: Carvão" required>
     <br><br> 
    <label for="usuario_id">Usuário:</label>

    <select name="usuario_id" id="usuario_id" required>
    <option value="">Selecione um Usuário</option>

    <?php
    while ($usuario = mysqli_fetch_assoc($resultado)) {
        echo "<option value='{$usuario['id_usuario']}'>";
        echo htmlspecialchars($usuario['nome']);
        echo "</option>";
    }
    ?>
</select>

<br><br>

    <button id="botaoCadastro" type="submit">Cadastrar Trem</button>
   <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
   <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_trem.php';">Visualizar Trens Cadastrados</button>
    </div>
    </form> 
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>