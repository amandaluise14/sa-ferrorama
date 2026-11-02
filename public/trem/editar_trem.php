<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

if (!isset($_GET['id_trem'])) {
    echo "ID do trem não informado.";
    exit;
}

$id_trem = (int) $_GET['id_trem'];

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
        header("Location: listar_trem.php");
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
    <title>Editar Trem</title>
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


<div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <input type="hidden" name="id_trem"
       value="<?php echo $trem['id_trem']; ?>">
            <h2 id="titulo-admin">Editar Trem</h2>
            <div class="conteudo">

<label>Modelo Trem:</label>
<input type="text" name="modelo" value="<?php echo $trem['modelo']; ?>" placeholder="Modelo 01" required>
<br><br>

<label>Velocidade Limite:</label>
<input type="text" name="velocidade" value="<?php echo $trem['velocidade']; ?>" placeholder="120 km/h" required>
<br><br>

<label>Linha:</label>
<input type="text" name="linha" value="<?php echo $trem['linha']; ?>" placeholder="Linha 1" required>
<br><br>

<label>Carga:</label>
<input type="text" name="carga" value="<?php echo $trem['carga']; ?>" placeholder="Carga Madeireira"required>
<br><br>


<button id="botaoCadastro" type="submit">Editar Trem</button>
<button class="botaoVisualizar" type="button" onclick="window.location.href='listar_trem.php';">Visualizar Trens Cadastrados</button>
<button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>

</div>
</form>
</div>
</body>
</html>


