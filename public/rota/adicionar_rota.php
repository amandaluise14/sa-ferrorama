<?php 

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $sensor_id = $_POST ['sensor_id'];

    $sql = "INSERT INTO rotas (nome, estacao_origem, estacao_destino, distancia_total, sensor_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nome, $estacao_origem, $estacao_destino, $distancia_total, $sensor_id);
     if ($stmt->execute() === TRUE) {
        echo "Nova rota cadastrada com sucesso";
 } else {
    echo "erro: " . $sql . "<br>" . $conn->error;
 }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Rota</title>
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

    <title>Cadastrar Rota</title>
      <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Cadastrar Rota</h2>
            <div class="conteudo">

    <label for="nome">Nome da rota:</label>
     <input type="text" id="nome" name="nome" placeholder="Ex: Rota 53" required>
     <br><br> 
    <label for="estacao_origem">Estação de origem:</label>
    <input type="text" id="estacao_origem" name="estacao_origem" placeholder="Ex: São Paulo" required>
     <br><br>
    <label for="estacao_destino">Estação de destino:</label>
    <input type="text" id="estacao_destino" name="estacao_destino" placeholder="Ex: Rio de Janeiro" required>
     <br><br>
    <label for= "distancia_total">Distância total:</label>
    <input type="number" id="distancia_total" name="distancia_total" placeholder="Ex: 100km" required>
     <br><br>
    <label for= "sensor_id">ID do sensor:</label>
    <input type="number" id="sensor_id" name="sensor_id" placeholder="Ex: 1" required>
     <br><br>
    

    <button id="botaoCadastro" type="submit">Cadastrar Rota</button>
   <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
   <button class="botaoVisualizar" type="button" onclick="window.location.href='visualizar_rota.php';">Visualizar Rotas Cadastradas</button>
    </div>
    </form> 
    </div>
</body>
</html>