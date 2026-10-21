<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

if (isset($_POST['id_rota'])) {
    $id = $_POST['id_rota'];
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $trem_id = $_POST['trem_id'];


$sql = "UPDATE rotas 
        SET nome = ?, 
            estacao_origem = ?, 
            estacao_destino = ?, 
            distancia_total = ?, 
            descricao = ?, 
            duracao = ?, 
            trem_id = ? 
        WHERE id_rota = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssssssii",
    $nome,
    $estacao_origem,
    $estacao_destino,
    $distancia_total,
    $descricao,
    $duracao,
    $trem_id,
    $id
);

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
    <link rel="stylesheet" href="../../style/style.css">
    <title>Editar Rota</title>

    
</head>
<body>

    <div class="d-flex align-items-start">
      
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


<a href="../pagina_monitoramento.php" class="menu-link">
    <li>Monitoramento</li>
</a>

<a href="../logout.php" class="menu-link">
    <li>Sair</li>
</a>

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

<label>Distancia total:</label>
<input type="text" name="distancia_total" value="<?php echo $rotas['distancia_total']; ?>" required>
<br><br>

<label>Estação Destino:</label>
<input type="text" name="estacao_destino" value="<?php echo $rotas['estacao_destino']; ?>" required>
<br><br>

<label>Descrição:</label>
<input type="longdescription" name="descricao" value="<?php echo $rotas['descricao']; ?>" required>
<br><br>

<label>Tempo previsto ou duração: </label>
<input type="text" name="duracao" value="<?php echo $rotas['duracao']; ?>" required>
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
        <button type="submit">Editar Rota</button>
    </form> 
</body>
</html>