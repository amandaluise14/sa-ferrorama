<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $sensor_id = $_POST['sensor_id'];

    $sql = "INSERT INTO rota (nome, estacao_origem, estacao_destino, distancia_total, sensor_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $estacao_origem, $estacao_destino, $distancia_total, $sensor_id);
    if ($stmt->execute() === TRUE) {
        echo "Nova rota cadastrada com sucesso!";
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
    <link rel="stylesheet" href="../../style/style.css">
    <title>Cadastrar Rota</title>
    <style>
</style>
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

            <form method="POST" class="forms_rotas">

                <div class="conteudo">

                    <h2 class="titulo-admin">Cadastrar Rota </h2>

                    <label for="nome">Nome da rota (linha):</label>
                    <input type="text" id="nome" name="nome" placeholder="Ex: Linha Norte" required>
                    <br><br>
                    <label for="estacao_origem">Estação Origem:</label>
                    <input type="text" id="estacao_origem" placeholder="Ex: Linha Norte" name="estacao_origem" required>
                    <br><br>
                    <label for="estacao_destino">Estação Destino:</label>
                    <input type="text" id="estacao_destino" placeholder="Ex: Linha Sudeste" name="estacao_destino"
                        required>
                    <br><br>
                    <label for="distancia_total"> Distância total: </label>
                    <select name="distancia_total" id="distancia_total" required>
                        <option value="">Selecione a distância</option>
                        <option value="10">10 km</option>
                        <option value="20">20 km</option>
                        <option value="30">30 km</option>
                        <option value="40">40 km</option>
                    </select>
                    <br><br>
                         
                    <label for="sensor_id">Sensor:</label>

                    <select name="sensor_id" required>
                        <option value="">Selecione o Sensor</option>

                    </select>
                    <button id="botaoCadastro" type="submit">Cadastrar Rota</button>
                    <button class="btn-cancelar" type="button" onclick="window.location.href='../../pagina_home.php';">Cancelar</button>
                    <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_rotas.php';">Visualizar Rotas Cadastradas</button>
                   <!-- <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_rotas.php';"> Visualizar Rotas Cadastradas </button> -->
                </div>
            </form>

        </div>

    </div>

</body>

</html>

