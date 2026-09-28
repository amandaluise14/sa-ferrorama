<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Listar Rotas</title>
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

        <h2 class="titulo-admin">Listar Rotas</h2>
    
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
                            <a href="#" class="editar">Editar</a>
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
            </form>

            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
