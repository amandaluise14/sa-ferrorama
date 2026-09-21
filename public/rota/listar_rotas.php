<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <title>Listar Rotas</title>
</head>

<body>

<div class="d-flex align-items-start">

    <div class="sidebar">
        <div class="logo">
            <img id="imagem_logo" src="../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

        <ul>
            <li class="active">Início</li>
            <li>Sensores e Trens</li>
            <li>Monitoramento</li>
            <li>Relatórios</li>
            <li>Adicionar usuário</li>
            <li>Sair</li>
        </ul>
    </div>

    <div class="container mt-4">

        <div class="d-flex align-items-center gap-3 mb-5">
            <img src="../assets/image/imagem_usuario.png"
                 alt="imagem usuário"
                 id="imagemUsuario">

            <h2 class="titulo-admin">
                Bem vindo, <?php echo $_SESSION['usuario']; ?>
            </h2>
        </div>

        <div class="table-responsive">

            <table class="table tabela-sensores">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Distância</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Joinville</td>
                        <td>Jaraguá do Sul</td>
                        <td>42 km</td>
                        <td>
                            <a href="#" class="excluir">Excluir</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Joinville</td>
                        <td>São Francisco do Sul</td>
                        <td>45 km</td>
                        <td>
                            <a href="#" class="excluir">Excluir</a>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Joinville</td>
                        <td>Curitiba</td>
                        <td>130 km</td>
                        <td>
                            <a href="#" class="excluir">Excluir</a>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


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

                <li>Início</li>
                <a href="../pagina_home.php" class="menu-link active"></a>
                <li class="active">Sensores e Trens</li>
                <a href="../pagina_home.php" class="menu-link active"></a>
                <li>Monitoramento</li>
                <li>Relatórios</li>
                <li>Adicionar usuário</li>
                <a href="../usuario/adicionar_usuario.php" class="menu-link active"></a>
                <li>Sair</li>
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
                    <button class="botaoVisualizar" type="button" onclick="window.location.href='../listar_rotas.php';">Visualizar Rotas Cadastradas</button>
                   <!-- <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_rotas.php';"> Visualizar Rotas Cadastradas </button> -->
                </div>
            </form>

        </div>

    </div>

</body>

</html>