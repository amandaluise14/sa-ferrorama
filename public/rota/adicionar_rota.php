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


 <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
        <li>Início</li>
        <li class="active">Sensores e Trens</li>
        <li>Monitoramento</li>
        <li>Relatórios</li>
        <li>Adicionar usuário</li>
        <li>Sair</li>
    </ul>
    </div>

    <title>Cadastrar Rota</title>
    <form method="POST">

 <div class="conteudo">

    <img src="../../assets/image/imagem_usuario.png" alt="imagem usuário" id="imagemUsuario">

<h2 class="titulo-admin">Cadastrar Rota </h2>

 

        <label for="nome">Nome da rota (linha):</label>
        <input type="text" id="nome" name="nome" placeholder="Ex: Linha Norte" required>
        <br><br>
        <label for="estacao_origem">Estação Origem:</label>
        <input type="text" id="estacao_origem" placeholder="Ex: Linha Norte" name="estacao_origem" required>
        <br><br>
        <label for="estacao_destino">Estação Destino:</label>
        <input type="text" id="estacao_destino" placeholder="Ex: Linha Sudeste" name="estacao_destino" required>
        <br><br>
        <label for="distancia_total"> Distância total: </label>
        <select name="distancia_total" id="distancia_total" required>
        <option value="">Selecione a distância</option>
        <option value="10">10 km</option>
        <option value="20">20 km</option>
        <option value="30">30 km</option>
        <option value="40">40 km</option>
        </select>
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

<br><br>

<div class="botoes">

            <button class="btn btn-cancelar">
                Cancelar
            </button>

            <button class="btn btn-salvar">
                Salvar
            </button>
</div>
    <?php 
        }  
    ?> 
</select>
</div>
</div>
</div>



</body> 
</html>


>