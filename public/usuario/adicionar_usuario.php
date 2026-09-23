<?php 

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);
     if ($stmt->execute() === TRUE) {
        echo "Novo usuário/administrador cadastrado com sucesso";
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
         <a href="../pagina_home.php" class="menu-link ">
                   <li>Início</li>
                </a>
                <a href="../pagina_sensoresetrens.php" class="menu-link ">
                    <li>Sensores e Trens</li>
                </a>
                <a href="../pagina_monitoramento.php" class="menu-link ">
                    <li>Monitoramento</li>
                </a>
                <a href="../pagina_relatorios.php" class="menu-link ">
                    <li>Relatórios</li>
                </a>
                <a href="../usuario/adicionar_usuario.php" class="menu-link ">
                    <li>Adicionar usuário</li>
                </a>
                <a href="../logout.php" class="menu-link ">
                    <li>Sair</li>
                </a>
    </ul>
    </div>

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


