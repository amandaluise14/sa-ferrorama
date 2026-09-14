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