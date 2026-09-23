<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ? ,? ,?)" ;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha);
    if ($stmt->execute() === TRUE){
        echo "Novo administrador/usuario cadastrado com sucesso!";
    } else {
        echo "Erro:" . $sql. "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário/administrador </title>
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

    <title> Cadastrar administrador/usuario</title>
    <div class= "formulario-container">
    <form methof="POST" class
     
    <h2 id="titulo-admin"> Cadastrar Sensor</h2>
            <div class="conteudo">
