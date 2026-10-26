<?php 

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';
$erro = '';
$sucesso = '';
$sql = "SELECT * FROM trens";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar trens: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $descricao= $_POST ['descricao'];
    $duracao = $_POST ['duracao'];
    $trem_id = $_POST ['trem_id'];



    $sql = "INSERT INTO rotas (nome, estacao_origem, estacao_destino, distancia_total, descricao, duracao, trem_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nome, $estacao_origem, $estacao_destino, $distancia_total,  $descricao, $duracao,$trem_id);
     if ($stmt->execute() === TRUE) {
        $sucesso = "Nova Rota cadastrada com sucesso";
 } else {
     $erro = "Erro ao cadastrar rota: " . $stmt->error;
 }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Rota</title>
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

    <title>Cadastar Rota </title>
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
            <h2 id="titulo-admin">Cadastrar Rota</h2>
            <div class="conteudo">

    <label for="nome">Nome:</label>
     <input type="text" id="nome" name="nome" placeholder="Ex: Rota da camomila" required>
     <br><br> 
    <label for="estacao_origem">Estação de origem:</label>
    <input type="text" id="estacao_origem" name="estacao_origem" placeholder="Ex: Estação Guanabara" required>
     <br><br>
    <label for= "estacao_destino">Estação destino:</label>
    <input type="text" id="estacao_destino" name="estacao_destino" placeholder="Ex: Estação itaum " required>
     <br><br>
     <label for= "distancia_total">Distância total(km):</label>
    <input type="number" id="distancia_total" name="distancia_total" placeholder="Ex: 5km" required>
     <br><br>
    <label for="descricao">Descrição:</label>
     <input type="text" id="endereco" name="descricao" placeholder="Ex: Um caminho longo" required>
     <br><br> 
    <label for="duracao">Tempo previsto de viagem:</label>
     <input type="text" id="duracao" name="duracao" placeholder="5 horas" required>
     <br><br> 
    <label for="trem_id">Trem vinculado:</label>
        <select name="trem_id" id="trem_id">
            <option value="">Selecione um Trem</option>
            <?php
            while ($trem = mysqli_fetch_assoc($resultado)) {
                echo "<option value='{$trem['id']}'>{$trem['modelo']}</option>";
            }
            ?>
        </select>
     <br><br> 



    <button id="botaoCadastro" type="submit">Cadastrar Rota</button>
   <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
   <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_rotas.php';">Visualizar Rotas cadastradas</button>
    </div>
    </form> 
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>