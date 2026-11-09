
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Relatórios | Info Trem</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="style/pagina_relatorios.css">

</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            <img src="../assets/image/logo_png_branca.png"
                 alt="Logo Info Trem">
        </div>

        <ul>

            <a href="pagina_home.php" class="menu-link">
                <li>Início</li>
            </a>

            <a href="#" class="menu-link">
                <li>Sensores e Trens</li>
            </a>

            <a href="#" class="menu-link">
                <li>Monitoramento</li>
            </a>

            <a href="pagina_relatorios.php" class="menu-link ativo">
                <li>Relatórios</li>
            </a>

            <a href="usuario/adicionar_usuario.php" class="menu-link">
                <li>Adicionar usuário</li>
            </a>

            <a href="logout.php" class="menu-link">
                <li>Sair</li>
            </a>

        </ul>

    </div>


    <!-- CONTEÚDO PRINCIPAL -->
    <main class="conteudo">

        <!-- TÍTULO -->
        <div class="titulo">

            <i class="bi bi-person-circle"></i>

            <h1>Relatório</h1>

        </div>


        <!-- FILTROS -->
        <div class="filtros">

            <div class="campo-filtro">

                <label for="data">Gerado em</label>

                <select id="data">

                    <option selected>Selecionar</option>
                    <option>Junho de 2026</option>
                    <option>Julho de 2026</option>
                    <option>Agosto de 2026</option>

                </select>

            </div>


            <div class="campo-filtro">

                <label for="tipo">Tipo de Relatório</label>

                <select id="tipo">

                    <option selected>Selecionar</option>
                    <option>Falha encontrada</option>
                    <option>Desempenho</option>
                    <option>Velocidade</option>

                </select>

            </div>


            <button type="button" class="btn-vinho">
                Filtrar
            </button>

        </div>


        <!-- TABELA -->
        <div class="container-tabela">

            <div class="titulo-tabela">
                Relatórios
            </div>

            <table class="tabela-relatorios">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo Relatório</th>
                        <th>Gerado em:</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Falha encontrada</td>
                        <td><span class="data-relatorio">14/06/2026</span></td>
                        <td><a class="visualizar">Visualizar</a></td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Desempenho</td>
                        <td><span class="data-relatorio">10/04/2026</span></td>
                        <td><a class="visualizar">Visualizar</a></td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Velocidade</td>
                        <td><span class="data-relatorio">05/08/2026</span></td>
                        <td><a class="visualizar">Visualizar</a></td>
                    </tr>

                </tbody>

            </table>

        </div>


        <!-- BOTÃO GERAR RELATÓRIO -->
        <div class="area-botao">

            <button type="button" class="btn-vinho">
                Gerar relatório
            </button>

        </div>

    </main>

</body>
</html>
