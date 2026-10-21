<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

if (!isset($_GET['id'])) {
    echo "ID do usuário não informado.";
    exit;
}

$id_trem = $_GET['id'];

$sql = "SELECT * FROM trens WHERE id_trem = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_trem);
$stmt->execute();

$resultado = $stmt->get_result();
$trem = $resultado->fetch_assoc();

if (!$trem) {
    echo "Trem não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modelo = $_POST['modelo'];
    $velocidade = $_POST['velocidade'];
    $linha = $_POST['linha'];
    $carga = $_POST['carga'];

    $sql = "UPDATE trens
            SET modelo=?,
                velocidade=?,
                linha=?,
                carga=?
            WHERE id_trem=?";

    $stmt = $conn->prepare($sql);

   $stmt->bind_param(
    "ssssi",
    $modelo,
    $velocidade,
    $linha,
    $carga,
    $id_trem
);

    if ($stmt->execute()) {
        header("Location: visualizar_trem.php");
        exit();
    } else {
        echo "Erro ao atualizar trem: " . $stmt->error;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Usuários/Administradores</title>
   <link rel="stylesheet" href="../../style/style.css">
   <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>

</head>
<body>
    <div class="pagina">

          <!-- Botão de voltar -->
        <button type="button" onclick="history.back()"
            aria-label="Voltar para a página anterior"
            style="position: absolute; top: 10px; left: 165px; background: none; border: none; cursor: pointer; font-size: 20px; color: black;">
            <i class="bi bi-arrow-90deg-left"></i>
        </button>
        
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


<div class="formulario-container">
<form method="POST" class="forms_sensores">

<h2 id="titulo-admin">Editar Trem</h2>

<label>Modelo Trem:</label>
<input type="text" name="modelo" value="<?php echo $trens['modelo']; ?>" required>
<br><br>

<label>Velocidade Limite:</label>
<input type="text" name="velocidade" value="<?php echo $trens['velocidade']; ?>" required>
<br><br>

<label>Linha:</label>
<input type="text" name="linha" value="<?php echo $trens['linha']; ?>" required>
<br><br>

<label>Carga:</label>
<input type="text" name="carga" value="<?php echo $trens['carga']; ?>" required>
<br><br>


<button id="botaoCadastro" type="submit">Editar Trem</button>
   <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>



</form>
</div>


</body>
</html>