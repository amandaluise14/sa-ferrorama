<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $sensor_id = $_POST['sensor_id'];

    $sql = "INSERT INTO rota (nome, estacao_origem, estacao_destino, distancia_total, sensor_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $estacao_origem, $estacao_destino, $distancia_total, $sensor_id);
    if ($stmt->execute() === TRUE) {
        echo "Nova rota cadastrada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Cadastrar Rota</title>
</head>
<body>

    <div class="d-flex align-items-start">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
        <li class="active">Início</li>
        <li>Sensores e Trens</li>
        <li>Monitoramento</li>
        <li>Relatórios</li>
        <li>Adicionar usuário</li>
        <li>Sair</li>
    </ul>
    </div>

    <title>Cadastrar Rota</title>
    <form method="POST">
        <div class="container mt-4">
 <div class="d-flex align-items-center gap-3 mb-5">

    <img src="../../assets/image/imagem_usuario.png"
        alt="imagem usuário"
 id="imagemUsuario">

<h2 class="titulo-admin">
Cadastrar Rota
   </h2>
 </div>
<div class="table-responsive">
        <label for="nome">Nome da rota (linha):</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="estacao_origem">Estação Origem:</label>
        <input type="text" id="estacao_origem" name="estacao_origem" required>
        <br><br>
        <label for="estacao_destino">Estação Destino:</label>
        <input type="text" id="estacao_destino" name="estacao_destino" required>
        <br><br>
        <label for="distancia_total">Distância Total:</label>
        <input type="text" id="distancia_total" name="distancia_total" required>
        <br><br>
       <button type="submit">Cadastrar Rota</button>

<br><br>

<select name="sensor_id" required>
    <option value="">Selecione o Sensor</option>

    <?php 
        $sql = "SELECT id, nome FROM sensores"; 
        $sensores = $conn->query($sql); 

        while ($sensor = $sensores->fetch_assoc()) { 
    ?> 

        <option value="<?php echo $sensor['id']; ?>">
            <?php echo $sensor['nome']; ?>
        </option> 

    <?php 
        }  
    ?> 
</select>
</div>
</div>

</body> 
</html>
