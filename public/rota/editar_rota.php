<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $sensor_id = $_POST['sensor_id'];


$sql = "UPDATE rotas SET nome = ?, estacao_origem = ?, estacao_destino = ?, distancia_total = ?, sensor_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("sssssi", $nome, $estacao_origem, $estacao_destino, $distancia_total, $sensor_id, $id);

if ($stmt->execute() === TRUE) {
    echo "Rota atualizada com sucesso!";
} else {
    echo "Erro ao atualizar rota: " . $stmt->error;
}

} else { echo "ID da rota não fornecido."; 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rota</title>
</head>
<body>

    <div class="d-flex align-items-start">
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

    <h2>Editar Rota</h2>
    <form method="POST">

<label>Nome:</label>
<input type="text" name="nome" value="<?php echo $rotas['nome']; ?>" required>
<br><br>

<label>Estação Origem:</label>
<input type="text" name="estacao_origem" value="<?php echo $rotas['estacao_origem']; ?>" required>
<br><br>

<label>Estação Destino:</label>
<input type="text" name="estacao_destino" value="<?php echo $rotas['estacao_destino']; ?>" required>
<br><br>

<label>Descrição:</label>
<input type="text" name="descricao" value="<?php echo $rotas['descricao']; ?>" required>
<br><br>

<label>Tempo previsto ou duração: </label>
<input type="text" name="duracao" value="<?php echo $rotas['duracao']; ?>" required>
<br><br>

<label>Data de criação: </label>
<input type="date" name="data_criacao" value="<?php echo $rotas['data_criacao']; ?>" required>
<br><br>

<label>Selecione o Trem Vinculado:</label>
<select name="trem_id" required>
    <option value="" >Selecione o Trem</option>
    <?php
        $sql = "SELECT id, nome FROM trens";
        $trens = $conn->query($sql);
        while ($trem = $trens->fetch_assoc()) {
    ?>

    <option value="<?php echo $trem['id'];?>" <?php if ($rota['trem_id'] == $trem['id']) echo 'selected'; ?>>
        <?php echo $trem['nome'];?>
    </option>


    <?php
        } 
    ?>
</select>
<br><br>






        <label for="nome">Nome:</label>
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
         <label for="Descrição">Descrição da Rota:</label>
        <input type="text" id="descricao" name="descricao" required>
        <br><br>
        <select name="sensor_id" required>
            <option value="" >Selecione o Sensor</option>
            <?php
                $sql = "SELECT id, nome FROM sensores";
                $sensores = $conn->query($sql);
                while ($sensor = $sensores->fetch_assoc()) {
            ?>

            <option value="<?php echo $sensor['id'];?>" <?php if ($rota['sensor_id'] == $sensor['id']) echo 'selected'; ?>>
                <?php echo $sensor['nome'];?>
            </option>


            <?php
                } 
            ?>
        </select>
        <button type="submit">Editar Rota</button>
    </form> 
</body>
</html>