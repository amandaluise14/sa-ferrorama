<?php

include '../../infra/conexao.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];


$sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
$stmt = $conexao->prepare($sql); 
$stmt->bind_param("ssi", $nome, $email, $id);

if ($stmt->execute() === TRUE) {
    echo "Usuário atualizado com sucesso!";
} else {
    echo "Erro ao atualizar usuário: " . $stmt->error;
}
 }

?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar administrador/usuário</title>
     <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <div class="pagina">
    <div class="sidebar">
<div class="logo">
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>
    <ul>
        <li>Início</li>
        <li class="active"> Sensores e Trens</li>
        <li>Monitoramento</li>
        <li>Relatórios</li>
        <li>Adicionar usuário</li>
        <li>Sair</li>
    </ul>
    </div>
     <div class= "formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin"Editar usuario>
</head>
<body> 
 
        <div class= "formulario-container">
<form method="POST">
        <div class="conteudo">
        <h2>Editar administrador/usuário</h2>
    
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="telefone">Senha</label>
        <input type="text" id="telefone" name="telefone">
        <br><br>

        <label for="endereco">Confirmar senha</label>
        <input type="text" id="endereco" name="endereco">
        <br><br>
        
        <label for="endereco">Status</label>
        <input type="text" id="endereco" name="endereco">
        <br><br>
        <button type="submit">Editar administrador/usuário</button>
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
    </div> 
    
    </form>
        </div>
        
</body>
</html>

