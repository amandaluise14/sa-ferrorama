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
        <li>Início</li>
        <li class="active"> Sensores e Trens</li>
        <li>Monitoramento</li>
        <li>Relatórios</li>
        <li>Adicionar usuário</li>
        <li>Sair</li>
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

    <label for="confirmar_senha">Confirmar Senha:</label>
<input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Digite a senha novamente" required>

<div id="erroSenha" class="erro"></div>

<br><br>

<label>Status:</label>
<select class="form-select" id="status" name="status" required>
    <option value="">Escolha</option>
    <option value="Ativo">Ativo</option>
    <option value="Inativo">Inativo</option>
</select>

<br><br>

<h3>Permissão de Acesso</h3>

<div class="row mt-4">

    <div class="col-md-6" id="permissao_ativa">
        <label class="card-permissao ativo d-flex align-items-start gap-3">
            <input type="radio" name="perfil" value="Administrador" required>

            <div>
                <h5>Administrador</h5>
                <p>
                    Controle completo do sistema, com gerenciamento de usuários,
                    sensores, trens e relatórios.
                </p>
            </div>
        </label>
    </div>

    <div class="col-md-6" id="permissao_inativa">
        <label class="card-permissao d-flex align-items-start gap-3">
            <input type="radio" name="perfil" value="Usuario">

            <div>
                <h5>Usuário</h5>
                <p>
                    Acesso restrito ao sistema, com permissão para visualização
                    de alguns dados e relatórios.
                </p>
            </div>
        </label>
    </div>

</div>

<br>
<input type="button" value="Cadastrar" id="btn-cadastrar">
        <button class="btn-cancelar" type="button" onclick="window.location.href='../../home.php';">Cancelar</button>
    </div>
    </form> 
    </div>
</body>
</html>