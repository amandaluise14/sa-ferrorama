<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'];
    $velocidade = $_POST['velocidade'];
    $linha = $_POST['linha'];
    $carga = $_POST['carga'];

    $sql = "INSERT INTO trem (modelo, velocidade, linha, carga) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $modelo, $velocidade, $linha, $carga);
    if ($stmt->execute() === TRUE) {
        echo "Novo trem cadastrado com sucesso!";
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
    <title>Cadastrar Trem</title>
 <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo"src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
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

    <div class="conteudo">
    <h2>Cadastrar Novo Trem</h2>
    <form method="POST">
        
        <label for="modelo">Modelo trem:</label>
        <input type="text" id="modelo" name="modelo" required>
       
        <label for="velocidade">Velocidade limite:</label>
        <input type="text" id="velocidade" name="velocidade" required>
        
        <label for="linha">Linha:</label>
        <input type="number" id="linha" name="linha" required>
        
        <label for="carga">Carga:</label>
        <input type="text" id="carga" name="carga" required>

        <div class="botoes">
        
       
    <button type="button" onclick="window.location.href='../../index.php'">
        Cancelar  
    </button>

    <button type="submit">
        Salvar

    </button>

</div>
</form>
</div>
</body>

