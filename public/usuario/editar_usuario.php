<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$id_usuario = $_GET['id_usuario'] ?? '';

$sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
$resultado = $conn->query($sql);
$usuario = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone  = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $data_nascimento = $_POST['data_nascimento'];
    $status_usuario = $_POST['status_usuario'];
   

    $sql = "UPDATE usuarios SET nome=?, email=?, senha=?, telefone=?, endereco=?, cpf=?, cargo=?, data_nascimento=?, status_usuario=? WHERE id_usuario=?";
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("sssssssssi", $nome, $email, $senha, $telefone, $endereco, $cpf, $cargo, $data_nascimento, $status_usuario, $id_usuario);
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
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <div class="pagina">
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

    <a href="../../adicionar_usuario.php" class="menu-link">
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
     <title>Editar Usuário </title>
      <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Editar Usuário</h2>
            <div class="conteudo">
                
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome"
                value="<?php echo $usuario['nome']; ?>" placeholder="João da Silva"required>
                <br><br>
                <label for="email">Email:</label>
                    <input type="email" id="email" name="email" 
                        value="<?php echo $usuario['email']; ?>" placeholder="joao.silva@example.com" required>
                <br><br>
                <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                <br><br>
                <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" 
                        value="<?php echo $usuario['telefone']; ?>" placeholder="(11) 99999-9999" required>
                <br><br>
                <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" 
                        value="<?php echo $usuario['endereco']; ?>" placeholder="Av. Paulista, 1000" required>
                <br><br>
                <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" 
                        value="<?php echo $usuario['cpf']; ?>" placeholder="123.456.789-00" required>
                <br><br>

                <select name="cargo" id="cargo" required>
                    <option value="">Selecione o cargo</option>
                    <option value="administrador" <?php if ($usuario['cargo'] === 'administrador') echo 'selected'; ?>>Administrador</option>
                    <option value="usuário" <?php if ($usuario['cargo'] === 'usuário') echo 'selected'; ?>>Usuário</option>
                </select>
                <br><br>
                <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" 
                        value="<?php echo $usuario['data_nascimento']; ?>" required>
                <br><br>

                <select name="status_usuario" id="status_usuario" required>
                    <option value="">Selecione o status</option>
                    <option value="ativo" <?php if ($usuario['status_usuario'] === 'ativo') echo 'selected'; ?>>Ativo</option>
                    <option value="inativo" <?php if ($usuario['status_usuario'] === 'inativo') echo 'selected'; ?>>Inativo</option>
                </select>
                <br><br>
                <button id="botaoCadastro" type="submit">Editar Usuário</button>
                <button class="botaoVisualizar" type="button" onclick="window.location.href='visualizar_usuario.php';">Visualizar Usuários Cadastrados</button>
                <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
            </div>
        </form> 
    </div>
</body>
</html>

