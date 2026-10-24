<?php 
session_start();
include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'];
    $velocidade = $_POST['velocidade'];
    $linha = $_POST ['linha'];
    $carga = $_POST ['carga'];
    $usuario_id = $_POST['usuario'];  
    
    if (empty($usuario_id)) {
        echo "Selecione um usuário antes de cadastrar o trem.";
    } else {

   $sql = "INSERT INTO trens (modelo, velocidade, linha, carga, usuario_id)
        VALUES (?, ?, ?, ? , ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssssi",
    $modelo,
    $velocidade,
    $linha,
    $carga,
    $usuario_id
);
     if ($stmt->execute() === TRUE) {
        echo "Novo trem cadastrado com sucesso";
 } else {
    echo "erro: " . $sql . "<br>" . $conn->error;
 }
$stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Trem </title>
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
      <label for="usuario">Usuário:</label>
        <select name="usuario" id="usuario">
            <option value="">Selecione um Usuário</option>
            <?php
            while ($usuario = mysqli_fetch_assoc($resultado)) {
                echo "<option value='{$usuario['id']}'>{$usuario['nome']}</option>";
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
</body>
</html>