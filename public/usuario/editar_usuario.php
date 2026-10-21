<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
<<<<<<< HEAD
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone  = $_POST['telefone'];
    $endereco =
    $cpf
    $cargo
    $data_nascimento
    $status_usuario
   

    $sql = "UPDATE sensores SET nome=?, localizacao=?, descricao_localizacao=?, dado_monitorado=? WHERE id_sensor=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $localizacao, $descricao_localizacao, $dado_monitorado, $id_sensor);
    if ($stmt->execute() === TRUE) {
        echo "Sensor atualizado com sucesso!";
=======
    $id_usuario = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $data_nascimento = $_POST['data_nascimento'];
    $status_usuario = $_POST['status_usuario'];

    $sql = "UPDATE usuarios SET nome=?, email=?, senha=?, telefone=?, endereco=?, cpf=?, cargo=?, data_nascimento=?, status_usuario=? WHERE id_usuario=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $senha, $telefone, $endereco, $cpf, $cargo, $data_nascimento, $status_usuario, $id_usuario);
    if ($stmt->execute() === TRUE) {
        echo "Usuário atualizado com sucesso!";
>>>>>>> 8feb9ade1509999c9d51b54940cd4c868fdf902c
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
<<<<<<< HEAD
    <title>Editar Sensor</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <div class="pagina">
=======
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../../style/style.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>
<body>
    <div class="pagina">

         <!-- Botão de voltar -->
        <button type="button" onclick="history.back()"
            aria-label="Voltar para a página anterior"
            style="position: absolute; top: 10px; left: 165px; background: none; border: none; cursor: pointer; font-size: 20px; color: black;">
            <i class="bi bi-arrow-90deg-left"></i>
        </button>
        
>>>>>>> 8feb9ade1509999c9d51b54940cd4c868fdf902c
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
    <div class="formulario-container">
        <form method="POST" class="forms_sensores">
<<<<<<< HEAD
            <h2 id="titulo-admin">Editar Sensor</h2>
=======
            <h2 id="titulo-admin">Editar Usuário</h2>
>>>>>>> 8feb9ade1509999c9d51b54940cd4c868fdf902c
            <div class="conteudo">
                
                <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome"required>
                <br><br>
<<<<<<< HEAD
                <label for="localizacao">Localização do Sensor:</label>
                <br>
                    <input type="radio" id="localizacao" name="localizacao" value="Trem" required>
                <label for="localizacao">Trem</label>
                <br>
                    <input type="radio" id="localizacao" name="localizacao" value="Rota" required>
                <label for="localizacao">Rota</label>
                <br><br>
                <label for="descricao_localizacao">Descricao da localizacao:</label>
                    <input type="text" id="descricao_localizacao" name="descricao_localizacao" >
                <br><br>
                <label for="dado_monitorado">Tipo do dado monitorado:</label>
                    <input type="text" id="dado_monitorado" name="dado_monitorado" >
                <br><br>
                <button id="botaoCadastro" type="submit">Editar Sensor</button>
=======
                <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                <br><br>
                <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                <br><br>
                <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" required>
                <br><br>
                <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                <br><br>
                <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required>
                <br><br>
                <label for="cargo">Cargo:</label>
                    <input type="text" id="cargo" name="cargo" required>
                <br><br>
                <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                <br><br>
                <label for="status_usuario">Status do Usuário:</label>
                    <select id="status_usuario" name="status_usuario">
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
            
                <button id="botaoCadastro" type="submit">Editar Usuário</button>
>>>>>>> 8feb9ade1509999c9d51b54940cd4c868fdf902c
                <button class="btn-cancelar" type="button" onclick="window.location.href='../../home.php';">Cancelar</button>
            </div>
        </form> 
    </div>
</body>
</html>