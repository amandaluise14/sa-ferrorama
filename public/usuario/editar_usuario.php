<?php

include '../../infra/conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    

    $sql = "UPDATE usuarios SET nome=?, email=?, senha=? WHERE id_usuario=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $senha, $id_usuario);
    if ($stmt->execute() === TRUE) {
        echo "Usuário atualizado com sucesso!";
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
    <title>Editar Usuário/administrador</title>
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
    <div class="formulario-container">
       <form method="POST" class="forms_usuarios">
            <h2 class="titulo-admin">Editar administrador/usuário</h2>
</head>
<body> 
 
        <div class= "formulario-container">
        <div class="conteudo">
    
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha">
        <br><br>

        <label for="confirmar senha">Confirmar senha</label>
        <input type="password" id="senha" name="senha">
        <br><br>
        
        <label for="status">Status</label>
        <input type="text" id="status" name="status">
        <br><br>
        <button id="botaoCadastro" type="submit">Editar Usuário</button>
        <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
        <button class="botaoVisualizar" type="button" onclick="window.location.href='visualizar_usuario.php';"> Voltar para Usuários Cadastrados </button>
    </div> 
    
    </form>
        </div>
        
</body>
</html>