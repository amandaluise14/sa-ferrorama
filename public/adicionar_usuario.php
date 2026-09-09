<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO cliente (nome, email, senha) VALUE ('$nome' , '$email', '$senha')';
 if ($conn->query($sql) === TRUE) { 
        echo "Novo cliente cadastrado com sucesso!";
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
    <title>Adicionar Novo cliente</title>
</head>
<body>
    <h2>Adicionar Novo Cliente</h2>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">
        <br><br>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco">
        <br><br>
        <button type="submit">Cadastrar Cliente</button>
    </form> 
    <br>  
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>

