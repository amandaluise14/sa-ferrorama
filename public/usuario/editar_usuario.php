<?php

include '../../infra/conexao.php';

if (!isset($_GET['id'])) {
    echo "ID do usuário não informado.";
    exit;
}

$id_usuario = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();

$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $data_nascimento = $_POST['data_nascimento'];
    $status_usuario = $_POST['status_usuario'];

    $sql = "UPDATE usuarios
            SET nome=?,
                email=?,
                senha=?,
                telefone=?,
                endereco=?,
                cpf=?,
                cargo=?,
                data_nascimento=?,
                status_usuario=?
            WHERE id_usuario=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssssssi",
        $nome,
        $email,
        $senha,
        $telefone,
        $endereco,
        $cpf,
        $cargo,
        $data_nascimento,
        $status_usuario,
        $id_usuario
    );

    if ($stmt->execute()) {
        header("Location: visualizar_usuario.php");
        exit();
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
    <title>Visualizar Usuários/Administradores</title>
   <link rel="stylesheet" href="../../style/style.css">
</head>
<body>

</head>
<body>
    <div class="pagina">
        <div class="sidebar">
            <div class="logo">
            <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
            </div>
            <ul>
            <a href="../pagina_home.php" class="menu-link "><li>Início</li></a>
            <a href="../pagina_sensoresetrens.php" class="menu-link "><li>Sensores e Trens</li></a>
            <a href="../pagina_monitoramento.php" class="menu-link "><li>Monitoramento</li></a>
            <a href="../pagina_relatorios.php" class="menu-link "><li>Relatórios</li></a>
            <a href="../usuario/adicionar_usuario.php" class="menu-link "><li>Adicionar usuário</li></a>
            <a href="../logout.php" class="menu-link "><li>Sair</li></a>
            </ul>
        </div>

<div class="formulario-container">
<form method="POST" class="forms_sensores">

<h2 id="titulo-admin">Editar Usuário</h2>

<label>Nome:</label>
<input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>
<br><br>

<label>Email:</label>
<input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
<br><br>

<label>Senha:</label>
<input type="text" name="senha" value="<?php echo $usuario['senha']; ?>" required>
<br><br>

<label>Telefone:</label>
<input type="text" name="telefone" value="<?php echo $usuario['telefone']; ?>" required>
<br><br>

<label>Endereço:</label>
<input type="text" name="endereco" value="<?php echo $usuario['endereco']; ?>" required>
<br><br>

<label>Data de nascimento:</label>
<input type="date" name="data_nascimento" value="<?php echo $usuario['data_nascimento']; ?>" required>
<br><br>

<label>CPF:</label>
<input type="text" name="cpf" value="<?php echo $usuario['cpf']; ?>" required>
<br><br>

<label>Cargo:</label>
<select name="cargo" required>
    <option value="Administrador" <?php if($usuario['cargo'] == 'Administrador') echo 'selected'; ?>>
        Administrador
    </option>

    <option value="Usuário" <?php if($usuario['cargo'] == 'Usuário') echo 'selected'; ?>>
        Usuário
    </option>
</select>

<br><br>

<label>Status:</label>
<select name="status_usuario" required>
    <option value="Ativo" <?php if($usuario['status_usuario'] == 'Ativo') echo 'selected'; ?>>
        Ativo
    </option>

    <option value="Inativo" <?php if($usuario['status_usuario'] == 'Inativo') echo 'selected'; ?>>
        Inativo
    </option>
</select>

<br><br>

<button id="botaoCadastro" type="submit">Editar Usuário</button>
   <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>



</form>
</div>

</body>
</html>