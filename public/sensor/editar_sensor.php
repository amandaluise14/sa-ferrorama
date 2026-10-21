<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id_sensor']) || empty($_POST['id_sensor'])) {
    die("ID do sensor não foi enviado.");
}

$id_sensor = (int) $_POST['id_sensor'];
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $descricao_localizacao = $_POST['descricao_localizacao'];
    $dado_monitorado = $_POST['dado_monitorado'];

    $sql = "UPDATE sensores SET nome=?, localizacao=?, descricao_localizacao=?, dado_monitorado=? WHERE id_sensor=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $localizacao, $descricao_localizacao, $dado_monitorado, $id_sensor);
    if ($stmt->execute() === TRUE) {
        echo "Sensor atualizado com sucesso!";
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
    <title>Editar Sensor</title>
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

                <a href="../usuario/adicionar_usuario.php" class="menu-link">
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
    <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Editar Sensor</h2>
            <div class="conteudo">
                
                <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome"required>
                <br><br>
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
                <button class="btn-cancelar" type="button" onclick="window.location.href='../../home.php';">Cancelar</button>
            </div>
        </form> 
    </div>
</body>
</html>