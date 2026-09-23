<?php 

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

<<<<<<< HEAD
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ? ,? ,?)" ;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha);
    if ($stmt->execute() === TRUE){
        echo "Novo administrador/usuario cadastrado com sucesso!";
    } else {
        echo "Erro:" . $sql. "<br>" . $conn->error;
    }
=======
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);
     if ($stmt->execute() === TRUE) {
        echo "Novo usuário/administrador cadastrado com sucesso";
 } else {
    echo "erro: " . $sql . "<br>" . $conn->error;
 }

>>>>>>> debf86f4901c86bd5e9c3848f437b30464c42d3b
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
=======
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
>>>>>>> debf86f4901c86bd5e9c3848f437b30464c42d3b
        <li>Início</li>
        <li class="active"> Sensores e Trens</li>
        <li>Monitoramento</li>
        <li>Relatórios</li>
        <li>Adicionar usuário</li>
        <li>Sair</li>
    </ul>
    </div>
<<<<<<< HEAD

    <title> Cadastrar administrador/usuario</title>
    <div class= "formulario-container">
    <form methof="POST" class
     
    <h2 id="titulo-admin"> Cadastrar Sensor</h2>
            <div class="conteudo">
=======

    <title>Cadastar Usuario/Administrador </title>
      <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Cadastrar Usuário/administrador</h2>
            <div class="conteudo">

    <label for="noeme">Nome:</label>
     <input type="text" id="nome" name="nome" placeholder="Ex: Sensor de velocidade do trem 77" required>
        <br><br>
    <label for="email">Email:</label>
    <br>
    <input type="email" id="email" name="email" placeholder="Ex: usuario@infotem" required>
    <br><br>
    <label for= "senha">Senha:</label>
    <br>
    <input type="password" id="senha" name="senha" placeholder="Ex: 12345" required>
    <br><br>

    <input type="submit" value="Cadastrar" id="botao-cadastrar">

    <button id="botaoCadastro" type="submit">Cadastrar Usuário/administrador</button>
        <button class="btn-cancelar" type="button" onclick="window.location.href='../../home.php';">Cancelar</button>
    </div>
    </form> 
    </div>
</body>
</html>


>>>>>>> debf86f4901c86bd5e9c3848f437b30464c42d3b
