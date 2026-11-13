
<?php

include '../infra/conexao.php';
include '../infra/verificar_admin.php';

function esc($valor)
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}

// Pesquisa
$busca = trim($_GET['busca'] ?? '');


// CONSULTA DOS SENSORES

$sql = "SELECT
            sensores.*,
            rotas.nome AS nome_rota
        FROM sensores
        LEFT JOIN rotas
            ON sensores.rota_id = rotas.id_rota";

if ($busca !== '') {

    $sql .= " WHERE
                CAST(sensores.id_sensor AS CHAR) LIKE ?
                OR sensores.nome LIKE ?
                OR sensores.descricao_localizacao LIKE ?
                OR sensores.dado_monitorado LIKE ?
                OR rotas.nome LIKE ?";

    $stmt = $conn->prepare($sql);

    $termo = '%' . $busca . '%';

    $stmt->bind_param(
        "sssss",
        $termo,
        $termo,
        $termo,
        $termo,
        $termo
    );

    $stmt->execute();

    $resultado = $stmt->get_result();

} else {

    $sql .= " ORDER BY sensores.id_sensor DESC";

    $resultado = $conn->query($sql);

}


// CONSULTA DOS TRENS

$sqlTrens = "SELECT
                trens.*,
                usuarios.nome AS nome_usuario
             FROM trens
             LEFT JOIN usuarios
                ON trens.usuario_id = usuarios.id_usuario";

if ($busca !== '') {

    $sqlTrens .= " WHERE
                    CAST(trens.id_trem AS CHAR) LIKE ?
                    OR trens.modelo LIKE ?
                    OR CAST(trens.velocidade AS CHAR) LIKE ?
                    OR CAST(trens.linha AS CHAR) LIKE ?
                    OR CAST(trens.carga AS CHAR) LIKE ?
                    OR usuarios.nome LIKE ?";

    $stmtTrens = $conn->prepare($sqlTrens);

    $termo = '%' . $busca . '%';

    $stmtTrens->bind_param(
        "ssssss",
        $termo,
        $termo,
        $termo,
        $termo,
        $termo,
        $termo
    );

    $stmtTrens->execute();

    $resultadoTrens = $stmtTrens->get_result();

} else {

    $sqlTrens .= " ORDER BY trens.id_trem DESC";

    $resultadoTrens = $conn->query($sqlTrens);

}


// ==================================
// DADOS DOS GRÁFICOS
// ==================================


// GRÁFICO DE VELOCIDADE DOS TRENS

$sqlVelocidade = "SELECT id_trem, modelo, velocidade
                  FROM trens
                  ORDER BY id_trem";

$resultadoVelocidade = $conn->query($sqlVelocidade);

$nomesTrens = [];
$velocidadesTrens = [];

while ($trem = $resultadoVelocidade->fetch_assoc()) {

    $nomesTrens[] = 'Trem ' . $trem['id_trem'] . ' - ' . $trem['modelo'];

    $velocidadesTrens[] = (float) $trem['velocidade'];

}


// GRÁFICO DE QUANTIDADE POR MODELO

$sqlModelo = "SELECT modelo, COUNT(*) AS quantidade
              FROM trens
              GROUP BY modelo";

$resultadoModelo = $conn->query($sqlModelo);

$nomesModelos = [];
$quantidadeModelos = [];

while ($modelo = $resultadoModelo->fetch_assoc()) {

    $nomesModelos[] = $modelo['modelo'];

    $quantidadeModelos[] = (int) $modelo['quantidade'];

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monitoramento | Info Trem</title>

    <link rel="stylesheet" href="../style/style.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="pagina">

    <!-- MENU LATERAL -->

    <aside class="sidebar">

        <div class="logo">

            <img
                id="imagem_logo"
                src="../assets/image/logo_png_branca.png"
                alt="Logo Info Trem"
            >

        </div>

          <ul>

                <?php if ($_SESSION['cargo'] === 'administrador'): ?>

                    <a href="pagina_home.php" class="menu-link">
                    <li><i class="bi bi-house-fill"></i> Início</li>
                </a>

                <a href="usuario/adicionar_usuario.php" class="menu-link">
                    <li><i class="bi bi-person-plus"></i> Adicionar usuário</li>
                </a>

                 <a href="rota/adicionar_rota.php" class="menu-link">
                    <li><i class="bi bi-signpost-2"></i> Rotas</li>
                </a>

                 <a href="trem/adicionar_trem.php" class="menu-link">
                    <li><i class="bi bi-train-front"></i> Trens</li>
                </a>

                 <a href="sensor/adicionar_sensor.php" class="menu-link">
                    <li><i class="bi bi-broadcast-pin"></i> Sensores</li>
                </a>


            <?php endif; ?>

            <a href="pagina_monitoramento.php" class="menu-link">
                <li><i class="bi bi-graph-up"></i> Monitoramento</li>
            </a>
            <br>
            <a href="logout.php" class="menu-link">
                <li><i class="bi bi-box-arrow-right"></i> Sair</li>
            </a>
        </ul>

    </aside>


    <!-- CONTEÚDO -->

    <main class="conteudo-monitoramento">

        <!-- CABEÇALHO -->

        <div class="cabecalho-monitoramento">

            <h1>Monitoramento</h1>

            <p>
                Visualize e acompanhe os sensores e trens do sistema.
            </p>

        </div>


        <!-- PESQUISA -->

        <form method="GET" class="formulario-busca">

            <div class="campo-busca">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="busca"
                    placeholder="Pesquisar sensor ou trem..."
                    value="<?= esc($busca) ?>"
                >

            </div>

            <button type="submit" class="botao-buscar">
                Pesquisar
            </button>

        </form>


        <!-- CARDS DOS SENSORES -->

        <div class="lista-sensores">

            <?php if ($resultado && $resultado->num_rows > 0): ?>

                <?php while ($sensor = $resultado->fetch_assoc()): ?>

                    <a
                        href="sensor/detalhes_sensor.php?id_sensor=<?= (int) $sensor['id_sensor'] ?>"
                        class="link-sensor"
                    >

                        <div class="card-sensor">

                            <div class="icone-sensor">

                                <i class="bi bi-broadcast"></i>

                            </div>

                            <div class="informacoes-sensor">

                                <h3>
                                    <?= esc($sensor['nome']) ?>
                                </h3>

                                <p>
                                    <?= esc($sensor['descricao_localizacao'] ?: 'Localização não informada') ?>
                                </p>

                                <span>
                                    <?= esc($sensor['dado_monitorado'] ?: 'Dado não informado') ?>
                                </span>

                            </div>

                            <i class="bi bi-chevron-right seta-sensor"></i>

                        </div>

                    </a>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="nenhum-sensor">

                    <i class="bi bi-cpu"></i>

                    <strong>Nenhum sensor encontrado.</strong>

                    <p>
                        Verifique a pesquisa ou cadastre um novo sensor.
                    </p>

                </div>

            <?php endif; ?>

        </div>


        <!-- TABELA DOS TRENS -->

        <h2 class="titulo-trem">Trens cadastrados</h2>

        <div class="table-responsive">

            <table class="tabela">

                <thead>

                    <tr class="cabecalho-tabela">

                        <th>Modelo</th>
                        <th>Velocidade Limite</th>
                        <th>Linha</th>
                        <th>Carga</th>
                        <th>Usuário responsável</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if ($resultadoTrens && $resultadoTrens->num_rows > 0): ?>

                        <?php while ($trem = $resultadoTrens->fetch_assoc()): ?>

                            <tr>

                                <td><?= esc($trem['modelo']) ?></td>

                                <td><?= esc($trem['velocidade']) ?></td>

                                <td><?= esc($trem['linha']) ?></td>

                                <td><?= esc($trem['carga']) ?></td>

                                <td><?= esc($trem['nome_usuario'] ?: 'Não informado') ?></td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="5">
                                Nenhum trem encontrado.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        <!-- GRÁFICOS DOS TRENS -->

        <h2 class="titulo-trem">Relatórios dos Trens</h2>

        <div class="graficos-trens">

            <!-- GRÁFICO DE VELOCIDADE -->

            <div class="card-grafico">

                <h3>Velocidade dos Trens</h3>

                <p>
                    Compare a velocidade registrada em cada trem.
                </p>

                <div class="area-grafico">

                    <canvas id="graficoVelocidade"></canvas>

                </div>

            </div>

            <!-- GRÁFICO DE MODELOS -->

            <div class="card-grafico">

                <h3>Quantidade de Trens por Modelo</h3>

                <p>
                    Visualize a quantidade de trens cadastrados por modelo.
                </p>

                <div class="area-grafico">

                    <canvas id="graficoModelo"></canvas>

                </div>

            </div>

        </div>

    </main>

</div>


<!-- DADOS DOS GRÁFICOS VINDOS DO PHP -->

<script>

    window.dadosGraficos = {

        nomesTrens: <?= json_encode($nomesTrens) ?>,

        velocidadesTrens: <?= json_encode($velocidadesTrens) ?>,

        nomesModelos: <?= json_encode($nomesModelos) ?>,

        quantidadeModelos: <?= json_encode($quantidadeModelos) ?>

    };

</script>


<!-- BIBLIOTECA CHART.JS -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- ARQUIVO JAVASCRIPT DOS GRÁFICOS -->

<script src="js/graficos_trens.js"></script>


</body>
</html>

<?php

if (isset($stmt)) {
    $stmt->close();
}

if (isset($stmtTrens)) {
    $stmtTrens->close();
}

?>
